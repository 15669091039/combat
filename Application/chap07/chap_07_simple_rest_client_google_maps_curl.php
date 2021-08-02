<?php
/**
 * Create by ZhangShuo
 * Date: 2021/7/30
 * Time: 15:59
 * When you read this code, good luck for you.
 */
include '../Autoload/Loader.php';
\Application\Autoload\Loader::init(__DIR__ . '/../..');

use Application\Web\Request;
use Application\Web\Client\Curl;

define('DEFAULT_ORIGIN','New York City');
define('DEFAULT_DESTINATION','Redondo Beach');
define('DEFAULT_FORMAT','json');
$apiKey='3GvE89GkKNIr3ktuwOOiUhkgSeRzjZQp';
$start='40.01116,116.339303';
$end='39.936404,116.452562';
$request=new Request('https://api.map.baidu.com/directionlite/v1/driving',Request::METHOD_GET
,[],['origin'=>$start,'destination'=>$end,'ak'=>$apiKey],[]);
$received=Curl::send($request);
$received2=\Application\Web\Client\Streams::send($request);
$routes=$received->getData();

?>
<?php foreach ($routes->result->routes[0]->steps as $item) : ?>
<br> distance:<?php echo $item->distance; ?>
<?php endforeach;?>

