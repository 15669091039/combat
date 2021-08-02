<?php
/**
 * Create by ZhangShuo
 * Date: 2021/7/23
 * Time: 11:04
 * When you read this code, good luck for you.
 */

namespace Application\Entity;


class Base
{
    protected $id = 0;
    protected $mapping = ['id' => 'id'];

    public function getId(): int
    {
        return  $this->id;
    }
    public function setId($id)
    {
        $this->id=(int)$id;
    }

    public static function arrayToEntity($data,Base $instance){
        if ($data&&is_array($data)){
            foreach ($instance->mapping as $dbColumn=>$propertyName){
                $method = 'set'.ucfirst($propertyName);
                $instance->$method($data[$dbColumn]);
            }
            return $instance;
        }
        return  false;
    }
    public  function entityToArray(){
        $data=array();
        foreach ($this->mapping as $dbColnum=>$propertyName){
            $method='get'.ucfirst($propertyName);
            $data[$dbColnum]=$this->$method()??null;
        }
        if (!empty($data)){
            return $data;
        }
        return false;
    }




}
