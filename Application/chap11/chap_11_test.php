<?php
/**
 * Create by ZhangShuo
 * Date: 2021/8/26
 * Time: 14:37
 * When you read this code, good luck for you.
 */

$redis=new  Redis();
$redis->connect('127.0.0.1',6379);
$redis->select(5);
// 字符串  整数 浮点数
$redis->set('num','hello','1000');  // 设置键值对
$redis->setex('num','888','im ex');  // 设置带倒计时的键值对
echo $redis->get('num');   // 获取键值对
echo $redis->ttl('num'); // 获取时间
$redis->del();
$redis->incr();
$redis->decr();
$redis->decrBy();
$redis->mset();
$redis->msetnx();
$redis->mget();
$redis->keys();
$redis->type();
// 哈希  散列
$redis->hget('','');
$redis->hSet('','','');
$redis->hMSet('',[]);
$redis->hMGet();
$redis->hKeys();
$redis->hVals();
$redis->hGetAll();
$redis->hIncrBy();
$redis->hDel();
$redis->hExists();
$redis->hLen();
$redis->hSetNx();
$redis->bitCount();
$redis->bitpos();


// 列表
$redis->lPush();
$redis->rPush();
$redis->lPop();
$redis->rPop();
$redis->lRange();
$redis->lRem();  // 从左边开始删除
$redis->lLen();

// 集合



// 有序集合













echo json_encode($redis->keys('*'));
//echo json_encode($redis->type('hello'));
$redis->del('hello ','num');
