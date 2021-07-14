<?php
/**
 * Create by ZhangShuo
 * Date: 2021/7/14
 * Time: 10:32
 * When you read this code, good luck for you.
 */

$foo=new class {
    public $baz = ['bada'=>'boom'];
};
$bar='baz';
echo  $foo->$bar['bada'];
