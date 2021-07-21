<?php
/**
 * Create by ZhangShuo
 * Date: 2021/7/21
 * Time: 10:45
 * When you read this code, good luck for you.
 */
define('DB_CONFIG_FILE','./../Database/config.php');
define('DEFAULT_TAG','img');

require __DIR__.'/../Autoload/Loader.php';
Application\Autoload\Loader::init(__DIR__.'/../..');
$config=include '../Database/config.php';
$connection=new \Application\Database\Connection($config);
$s=$connection->pdo->query('select * from user_book')->fetchAll();
var_dump($s);
