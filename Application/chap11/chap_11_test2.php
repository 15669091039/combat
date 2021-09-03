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
//// 字符串  整数 浮点数
//$redis->set('num','hello','1000');  // 设置键值对
//$redis->setex('num','888','im ex');  // 设置带倒计时的键值对
//echo $redis->get('num');   // 获取键值对
//echo $redis->ttl('num'); // 获取时间
//$redis->del();
//$redis->incr();
//$redis->decr();
//$redis->decrBy();
//$redis->mset();
//$redis->msetnx();
//$redis->mget();
//$redis->keys();
//$redis->type();
//// 哈希  散列
//$redis->hget('','');
//$redis->hSet('','','');
//$redis->hMSet('',[]);
//$redis->hMGet();
//$redis->hKeys();
//$redis->hVals();
//$redis->hGetAll();
//$redis->hIncrBy();
//$redis->hDel();
//$redis->hExists();
//$redis->hLen();
//$redis->hSetNx();
//$redis->bitCount();
//$redis->bitpos();
//
//
//// 列表
//$redis->lPush();
//$redis->rPush();
//$redis->lPop();
//$redis->rPop();
//$redis->lRange();
//$redis->lRem();  // 从左边开始删除
//$redis->lLen();
//
//// 集合
//
//
//
//// 有序集合
//
//
//
//
//
//
//
//
//
//
//
//
//
//echo json_encode($redis->keys('*'));
////echo json_encode($redis->type('hello'));
//$redis->del('hello ','num');


//$redis->lPush('id3',8888);
//$redis->lPush('id3','gggg');
////echo json_encode($redis->rPop('id3'));
//echo $redis->lLen('id3');
//echo json_encode($redis->lRange('id3',-5,-1));
//$redis->lRem('id3','8888',-3);
//$redis->lIndex('id',3);
//$redis->lSet('id',3,0);
//$redis->lTrim();

//$redis->sAdd('bbb',[2,3,4,5]);
//$redis->sRem('bbb','');
//$redis->sMembers('bbb'); // 查询集合内所有内容
//$redis->sIsMember('bbb',666);
//$redis->sDiff();
//$redis->sUnion();
//$redis->sInter();
//$redis->sDiffStore();
//$redis->sUnionStore();
//$redis->sInterStore();
//$redis->sIsMember();
//$redis->sMembers();
//$redis->sCard(); // 获得元素个数;
//$redis->sRandMember(); // 随机获得集合中的元素
//$redis->sPop();
//$redis->rawCommand();
for ($i=0;$i<3;$i++){
   $s= $redis->brPop(['myrenwu','register'],2);
}

//
//var_dump($redis->zAdd('zhangsan',67,888));
//var_dump($redis->zRange('zhangsan',0,4,true));
//echo $redis->zScore('zhangsan',888);
