<?php
/**
 * Create by ZhangShuo
 * Date: 2021/7/22
 * Time: 14:41
 * When you read this code, good luck for you.
 */


trait Test{
    protected $id;
    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id=$id;
    }
    public function setName($name){
        $obj=new stdClass();
        $obj->name=$name;
        $this->name=$obj;
    }
}



class Customer{
    use Test;
    protected  $name;
    public function getName(){
        return $this->name;
    }
    public function setName($name){
        $this->name=$name;
    }
}
$customer=new Customer();
$customer->setId(100);
$customer->setName('fred');
var_dump($customer);

