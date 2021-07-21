<?php
/**
 * Create by ZhangShuo
 * Date: 2021/7/21
 * Time: 10:23
 * When you read this code, good luck for you.
 */



require __DIR__.'/../Autoload/Loader.php';
Application\Autoload\Loader::init(__DIR__.'/../..');
$config=include '../Database/config.php';
$connection=new \Application\Database\Connection($config);
$test=new \Application\chap04\Test();
echo $test->getTest();
