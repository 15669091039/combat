<?php
namespace Application\chap04;
/**
 * Create by ZhangShuo
 * Date: 2021/7/21
 * Time: 10:03
 * When you read this code, good luck for you.
 */
/**
 * 这是一个示例类
 * 这个类的作用是获取和设置
 * 受保护的属性（即私有变量）$test
 */

class Test{
    protected $test='TEST';

    /**
     * 该方法会返回变量$test的当前值
     * @return string
     */
    public function getTest(){
        return $this->test;
    }

    /**
     * 该方法接收一个字符串，并设置变量test的值 并返回
     * @param string $test
     * @return string
     */
    public function setTest(string $test){
        $this->test=$test;
        return $this->test;
    }




}


