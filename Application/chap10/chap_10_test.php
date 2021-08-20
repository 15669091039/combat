<?php
/**
 * Create by ZhangShuo
 * Date: 2021/8/20
 * Time: 15:41
 * When you read this code, good luck for you.
 */
$redis=new Redis();
$redis->connect('127.0.0.1');
$redis->select(5);
//echo $redis->lPush('hello ',1,2,3);
//echo $redis->lRange('hello',0,-1);
echo $redis->incr('num');
