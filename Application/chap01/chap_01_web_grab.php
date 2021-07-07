<?php
/**
 * Create by ZhangShuo
 * Date: 2021/7/5
 * Time: 16:03
 * When you read this code, good luck for you.
 */
define('DEFAULT_URL','www.xinhuxinli.com');
define('DEFAULT_TAG','img');

require __DIR__.'/../Autoload/Loader.php';
Application\Autoload\Loader::init(__DIR__.'/../..');
$test=new Application\test\WebGrab();
$url=strip_tags($_GET['url']??DEFAULT_URL);
$tag=strip_tags($_GET['tag']??DEFAULT_TAG);

echo json_encode(
    [
        'message'=>'获取成功',
        'attribute'=>$test->getAttribute($url,'src'),
        'tag'=>$test->getTags($url,$tag)
    ]);



