<?php
/**
 * Create by ZhangShuo
 * Date: 2021/7/22
 * Time: 17:25
 * When you read this code, good luck for you.
 */
//$param=[
//    'host'=>'127.0.0.1',
//    'port'=>'3306',
//    'username'=>'root',
//    'password'=>'zsyt1314',
//    'dbname'=>'php7cookbook'
//];
//try {
//    $dsn=sprintf('mysql:host=%s;dbname=%s',$param['host'],$param['dbname']);
//    $pdo=new PDO($dsn,$param['username'],$param['password']);
//}catch (PDOException $e){
//    echo  $e->getMessage();
//}catch (Throwable $e){
//   echo $e->getMessage();
//}


include '../Autoload/Loader.php';
\Application\Autoload\Loader::init(__DIR__.'/../..');




$sql=\Application\Database\Finder::select('user_examiner_teacher')->where('id>0')->and('id<40')->getSql();
$pdo=new \Application\Database\Connection(include '../Database/config.php');

var_dump($pdo->pdo->query($sql)->fetchAll());
