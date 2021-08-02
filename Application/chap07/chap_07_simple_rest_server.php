<?php
/**
 * Create by ZhangShuo
 * Date: 2021/7/30
 * Time: 19:27
 * When you read this code, good luck for you.
 */
include '../Autoload/Loader.php';
\Application\Autoload\Loader::init(__DIR__ . '/../..');

$dbparams=include '../Database/config.php';
$server=new \Application\Web\Rest\Server(new \Application\Web\Rest\CustomerApi(666,$dbparams,'id'));
$server->listen();
exit();
