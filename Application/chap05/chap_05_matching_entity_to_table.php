<?php
/**
 * Create by ZhangShuo
 * Date: 2021/7/24
 * Time: 10:40
 * When you read this code, good luck for you.
 */
include '../Autoload/Loader.php';
\Application\Autoload\Loader::init(__DIR__.'/../..');
$conn=new \Application\Database\Connection(include '../Database/config.php');
$id=rand(1,79);
$stmt=$conn->pdo->prepare('select * from customer where id=:id');
$stmt->execute(['id'=>$id]);
$result=$stmt->fetch(PDO::FETCH_ASSOC);
$cust=\Application\Entity\Customer::arrayToEntity($result,new \Application\Entity\Customer());
var_dump($cust);

