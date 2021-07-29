<?php
/**
 * Create by ZhangShuo
 * Date: 2021/7/28
 * Time: 16:52
 * When you read this code, good luck for you.
 */

namespace Application\Filter;


class Filter  extends AbstractFilter
{
    public function process(array $data)
    {
        if(!(isset($this->assignments))&&count($this->assignments)){
            return null;
        }
        foreach ($data as $key=>$value){
            $this->results[$key]=new Result($value,[]);
        }
        $toDo=$this->assignments;
        if (isset($toDo['*'])){
            $this->processGlobalAssignment($toDo['*'],$data);
            unset($toDo['*']);
        }
//        foreach ($toDo as $key=>$assignment){
//            $this->processAssignment($assignment,$key);
//        }
    }
    protected function processGlobalAssignment($assignment,$data){
        foreach ($assignment as $callback){
            if ($callback===null)continue;
            foreach ($data as $k=>$value){
                $result=$this->callbacks[$callback['key']]($this->results[$k]->item,$callback['params']);
                $this->results[$k]->mergeResults($result);
            }
        }
    }
    protected function processAssignment($assignment,$key)
    {
        foreach ($assignment as $callback){
            if ($callback===null) continue;
            $result=$this->callbacks[$callback['key']]($this->results[$key]->item,$callback['params']);
            $this->results[$key]->mergeResults($result);
        }
    }



}
