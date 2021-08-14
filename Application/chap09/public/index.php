<?php
/**
 * Create by ZhangShuo
 * Date: 2021/8/14
 * Time: 11:28
 * When you read this code, good luck for you.
 */
session_start();
session_regenerate_id();

define('DB_CONFIG_FILE', __DIR__ . '/../Database/config.php');
define('DB_TABLE', 'customer_09');
define('SESSION_KEY', 'auth');
define('PAGE_DIR', '../pages/');
include '../../Autoload/Loader.php';
\Application\Autoload\Loader::init(__DIR__ . '/../..');

use Application\Database\Connection;
use Application\Acl\{DbTable, Authenticate};
use Application\Middleware\{ServerRequest, Request, Constants, TextStream};
use Application\Acl\Acl;

$config = include '../chap_09_middleware_acl_config.php';
$acl = new Acl([]);
$conn = new Connection(include DB_CONFIG_FILE);
$dbAuth = new DbTable($conn, DB_TABLE);
$auth = new Authenticate($dbAuth, SESSION_KEY);
$incomming = new ServerRequest();
$incomming->initialize();
$outbound = new Request();
if ($incomming->getMethod() == Constants::METHOD_POST) {
    $body = new TextStream(json_encode($incomming->getParsedBody()));
    $response = $auth->login($outbound->withBody($body));
}
$action = $incomming->getServerParams()['PHP_SELF'];
$info = $_SESSION[SESSION_KEY] ?? false;
if (!$info) {
    $execute = function () use ($auth) {
        include PAGE_DIR . 'auth.php';
    };
} else {
    $query = $incomming->getServerParams()['QUERY_STRING'] ?? '';
    $outbound->withBody(new TextStream(json_encode($info)));
    $outbound->getUri()->withQuery($query);
    $response = $acl->isAuthorized($outbound);
    $params = json_decode($response->getBody()->getContents());
    $isAllowed = $params->authorized ?? false;
    if ($isAllowed) {
        $execute = function () use ($response, $params) {
            include PAGE_DIR.'/'.$params->page.'.php';
            echo '<pre>',var_dump($response),'<pre>';
            echo '<pre>',var_dump($_SESSION[SESSION_KEY]);
            echo '</pre>';
        };
    }else{
        $execute = function () use ($response, $params) {
            include PAGE_DIR.'/'.$params->page.'.php';
            echo '<pre>',var_dump($response),'<pre>';
            echo '<pre>',var_dump($_SESSION[SESSION_KEY]);
            echo '</pre>';
        };
    }
}


?>
<?= $auth->getLoginForm($action) ?>
