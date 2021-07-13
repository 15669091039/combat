<?php
/**
 * Create by ZhangShuo
 * Date: 2021/7/13
 * Time: 15:13
 * When you read this code, good luck for you.
 */
function test(){
    return [
      1=>function(){return [
          1=>function ($a){return 'level1/1:'.++$a;},
          2=>function ($a) {return 'level1/2:'.++$a;}];
      },
      2=>  function(){return [
          1=>function ($a){return 'level2/1:'.++$a;},
          2=>function ($a) {return 'level2/2:'.++$a;}];
      },
    ];
}
$a='t';
$t='test';

echo $$a()[1]()[2](100);
