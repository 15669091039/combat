<?php
/**
 * Create by ZhangShuo
 * Date: 2021/7/19
 * Time: 16:35
 * When you read this code, good luck for you.
 */
// 迭代器


$array=[666,777];
$s=new ArrayIterator($array);
$s->append('999');

while ($value=$s->current()){

    $s->next();
    echo $value;
};
function callBack(){

}
//foreach ($s as $val ){
//    echo  $val;
//}
echo 'hello';
var_dump($array);
