<?php
/**
 * Create by ZhangShuo
 * Date: 2021/7/22
 * Time: 14:30
 * When you read this code, good luck for you.
 */
trait Test{
    public function setId($id){
        $obj=new stdClass();
        $obj->id=$id;
        $this->id=$obj;
    }
}
class Base{
    protected $id;
    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id=$id;
    }
}


class Customer extends Base{
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
