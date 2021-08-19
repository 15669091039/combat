<?php
include '../Autoload/Loader.php';



$arr=[
    ['id'=>1,'name'=>'zhangsan'],
    ['id'=>2,'name'=>'lisi']
];
use Application\generic\Search;
$search=new Search($arr);
$search->binarySearch(['id'=>1,'name'=>'zhangsan'],'name');
var_dump($search);