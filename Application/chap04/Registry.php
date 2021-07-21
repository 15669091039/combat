<?php
/**
 * Create by ZhangShuo
 * Date: 2021/7/21
 * Time: 14:58
 * When you read this code, good luck for you.
 */

namespace Application\chap04;


class Registry
{
    protected static $instance =NULL;
    protected $registry=array();
    public function __construct()
    {
        // 谁都不能为这个类创建实例
    }
    public static function getInstance(){
        if (!self::$instance){
            self::$instance=new self();
        }
        return self::$instance;
    }
    public function __get($key){
        return $this->registry[$key]??null;
    }
    public function __set($key,$value){
        $this->registry[$key]=$value;
    }

}
