<?php
/**
 * Create by ZhangShuo
 * Date: 2021/7/2
 * Time: 16:33
 * When you read this code, good luck for you.
 */
$S=__DIR__;
require __DIR__.'/../Autoload/Loader.php';
Application\Autoload\Loader::init(__DIR__.'/../..');
$test=new Application\test\TestClass();
echo $test->getTest();


$fake=new Application\test\FakeClass();
echo $fake->getTest();
