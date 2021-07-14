<?php
/**
 * Create by ZhangShuo
 * Date: 2021/7/14
 * Time: 10:32
 * When you read this code, good luck for you.
 */

$a=[1,2,3];
//$b=&$a;
foreach ($a as $val){
    echo $val.'-'.current($a).'<br>';
//    printf('%2d\n',$val);
    unset($a[1]);
}
