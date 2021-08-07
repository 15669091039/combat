<?php
/**
 * Create by ZhangShuo
 * Date: 2021/8/7
 * Time: 12:11
 * When you read this code, good luck for you.
 */
include '../Autoload/Loader.php';
\Application\Autoload\Loader::init(__DIR__ . '/../..');

use Application\Middleware\Uri;
$uri=new Uri();
$uri->withScheme('https')
    ->withHost('ltshop.azhudong.com')
    ->withPort('443')
    ->withPath('chap_09_middleware_value_objects_uri.php')
    ->withQuery('param=test');
echo $uri;
