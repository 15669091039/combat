<?php
/**
 * Create by ZhangShuo
 * Date: 2021/8/12
 * Time: 16:39
 * When you read this code, good luck for you.
 */
include '../Autoload/Loader.php';
\Application\Autoload\Loader::init(__DIR__ . '/../..');
$request=new \Application\Middleware\ServerRequest();
$request->initialize();
//echo json_encode((array)$request);
echo '<pre>',var_dump($request),'<pre>';


