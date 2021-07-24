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
trait TestList{
    protected $ids;

    public function setId($ids){
        $this->ids=$ids;
    }
}



class Customer{
    use Test,TestList {Test::setId insteadof TestList;TestList::setId as setIdList;}
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
$customer->setIdList(100);
$customer->setName('fred');
var_dump($customer);

