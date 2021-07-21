<?php
/**
 * Create by ZhangShuo
 * Date: 2021/7/21
 * Time: 16:35
 * When you read this code, good luck for you.
 */
require __DIR__.'/../Autoload/Loader.php';
Application\Autoload\Loader::init(__DIR__.'/../..');
$config=include '../Database/config.php';
$list=\Application\generic\ListFactory::factory(new \Application\generic\CountryList(),$config);
foreach ($list->list() as $item) echo $item.'';

