<?php
/**
 * Create by ZhangShuo
 * Date: 2021/7/21
 * Time: 11:21
 * When you read this code, good luck for you.
 */
require __DIR__.'/../Autoload/Loader.php';
Application\Autoload\Loader::init(__DIR__.'/../..');

$s=new \Application\chap04\Customer();
echo  $s->LOCAL;
