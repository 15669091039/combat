<?php
/**
 * Create by ZhangShuo
 * Date: 2021/7/28
 * Time: 19:07
 * When you read this code, good luck for you.
 */

namespace Application\Filter;


class Validator extends AbstractFilter
{
    public function process(array $data)
    {
        $valid=true;
        if (!isset($this->assignments)&&count($this->assignments)){
            return $valid;
        }
        foreach ($data as $key=>$val){
            $this->results[$key]=new Result(true,[]);
        }
        $toDo=$this->assignments;
        if (isset($toDo['*'])){
            $this->processGlobalAssignment($toDo['*'],$data);
            unset($toDo['*']);
        }
        foreach ($toDo as $key=>$assignment){
            if (!isset($data[$key])){
                $this->results[$key]=new Result(false,$this->missingMessage);
            }else{
                $this->processAssignment($assignment,$key,$data[$key]);
            }
            if (!$this->results[$key]->item) $valid=false;
        }
        return  $valid;
    }
    protected function processGlobalAssignment($assignment,$data){
        foreach ($assignment as $callback){
            if ($callback===null)continue;
            foreach ($data as $k=>$value){
                $result=$this->callbacks[$callback['key']]($this->results[$k]->item,$callback['params']);
                $this->results[$k]->mergeValidationResults($result);
            }
        }
    }
    protected function processAssignment($assignment,$key,$value)
    {
        foreach ($assignment as $callback){
            if ($callback===null) continue;
            $result=$this->callbacks[$callback['key']]($this->results[$key]->item,$callback['params']);
            $this->results[$key]->mergeValidationResults($result);
        }
    }



}
