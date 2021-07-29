<?php
/**
 * Create by ZhangShuo
 * Date: 2021/7/28
 * Time: 15:26
 * When you read this code, good luck for you.
 */

namespace Application\Filter;


class Result
{
    public $item;
    public $messages=[];
    public function __construct($item,$message){
        $this->item=$item;
        if (is_array($message)){
            $this->messages=$message;
        }else{
            $this->messages=[$message];
        }
    }
    public function mergeResults(Result $result){
        $this->item=$result->item;
        $this->mergeMessage($result);
    }
    public function mergeMessage(Result $result){
        if (isset($result->messages)&&is_array($result->messages)){
            $this->messages=array_merge($this->messages,$result->messages);
        }
    }

    public function mergeValidationResults(Result $result){
        if ($this->item==true){
            $this->item=(bool) $result->item;
        }
        $this->mergeMessage($result);
    }









}
