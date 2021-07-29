<?php
/**
 * Create by ZhangShuo
 * Date: 2021/7/28
 * Time: 15:40
 * When you read this code, good luck for you.
 */

namespace Application\Filter;

use UnexpectedValueException;
abstract class AbstractFilter
{
    const BAD_CALLBACK='Must Implement CallbackInterface';
    const DEFAULT_SEPARATOR='<br>';
    const MISSING_MESSAGE_KEY='item.message';
    const MISSING_MESSAGE_FORMAT='%20s : %60s';
    const MISSING_MESSAGE_MESSAGE='Item Message';
    protected $separator;
    protected $callbacks;
    protected $assignments;
    protected $missingMessage;
    protected $results=[];
    public function __construct(array $callbacks,array  $assignments,$separator=null,$message=null)
    {
        $this->setCallbacks($callbacks);
        $this->setAssignments($assignments);
        $this->setSeparator($separator??self::DEFAULT_SEPARATOR);
        $this->setMissingMessage($message??self::MISSING_MESSAGE_MESSAGE);
    }

    public function setAssignments(array $assignment)
    {
        $this->assignments=$assignment;
    }
    public function setSeparator($separator){
        $this->separator=$separator;
    }
    public function setMissingMessage($message){
        $this->missingMessage=$message;
    }

    public function getCallbacks()
    {
        return $this->callbacks;
    }
    public function getOneCallback($key)
    {
        return $this->callbacks[$key]??null;
    }
    public function setCallbacks(array  $callbacks)
    {
        foreach ($callbacks as $key=>$item){
            $this->setOneCallback($key,$item);
        }
    }
    public function setOneCallback($key,$item)
    {
        if ($item instanceof  CallbackInterface){
            $this->callbacks[$key]=$item;
        }else{
            throw new UnexpectedValueException(self::BAD_CALLBACK);
        }
    }
    public function removeOneCallback($key)
    {
        if (isset($this->callbacks[$key]))unset($this->callbacks[$key]);
    }
    public function getResults()
    {
        return $this->results;
    }
    public function getItemsAsArray()
    {
        $return=array();
        if ($this->results){
            foreach ($this->results as $key=>$item)
            $return[$key]=$item->item;
        }
        return $return;
    }

    public function getMessages(){
        if ($this->results){
            foreach ($this->results as $key=>$item)
                if ($item->message) yield from $item->messages;
        }else{
            return array();
        }
    }
    public function getMessageString($width=80,$format=null)
    {
        if (!$format)
            $format=self::MISSING_MESSAGE_FORMAT.$this->separator;
        $output=' ';
        if ($this->results){
            foreach ($this->results as $key=>$value){
                if ($value->messages){
                    foreach ($value->messages as $message){
                        $output.=sprintf($format,$key,trim($message));
                    }
                }
            }
        }
        return $output;
    }





}
