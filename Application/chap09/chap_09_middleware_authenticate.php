<?php
/**
 * Create by ZhangShuo
 * Date: 2021/8/12
 * Time: 19:04
 * When you read this code, good luck for you.
 */
session_start();
define('DB_CONFIG_FILE',__DIR__.'/../Database/config.php');
define('DB_TABLE','customer_09');
define('SESSION_KEY','auth');
include '../Autoload/Loader.php';
\Application\Autoload\Loader::init(__DIR__ . '/../..');

use Application\Database\Connection;
use Application\Acl\{DbTable,Authenticate};
use Application\Middleware\{ServerRequest,Request,Constants,TextStream};
$conn=new Connection(include DB_CONFIG_FILE);
$dbAuth=new DbTable($conn,DB_TABLE);
$auth=new Authenticate($dbAuth,SESSION_KEY);
$incomming=new ServerRequest();
$incomming->initialize();
$outbound= new Request();
if ($incomming->getMethod()==Constants::METHOD_POST){
    $body=new TextStream(json_encode($incomming->getParsedBody()));
    $response=$auth->login($outbound->withBody($body));
}
$action=$incomming->getServerParams()['PHP_SELF'];
?>
<?= $auth->getLoginForm($action)?>
