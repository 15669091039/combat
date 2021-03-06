<?php
/**
 * Create by ZhangShuo
 * Date: 2021/8/25
 * Time: 9:12
 * When you read this code, good luck for you.
 */

namespace Application\Error;


class Handler
{
    protected $logFile;
    public function __construct($logFileDir=null,$logFile=null){
        $logFile=$logFile??date('Ymd').'log';
        $logFileDir=$logFileDir??__DIR__;
        $this->logFile=$logFileDir.'/'.$logFile;
        $this->logFile=str_replace('//','/',$this->logFile);
        set_exception_handler([$this,'exceptionHandler']);
    }
    public function exceptionHandler($ex){
        $message=sprintf('%19s:%20s:$s'.PHP_EOL,date('Y-m-d h:i:s'),get_class($ex),$ex->getMessage());
        file_put_contents($this->logFile,$message,FILE_APPEND);
    }


}
