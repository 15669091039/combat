<?php
/**
 * Create by ZhangShuo
 * Date: 2021/7/14
 * Time: 11:35
 * When you read this code, good luck for you.
 */

namespace Application\Web;

use Exception;
use SplFileObject;
class  Access
{
    const ERROR_UNABLE = 'ERROR: unable to open file';
    protected  $log;
    public $frequency=array();
    public function __construct($filename){
        if (!file_exists($filename)){
            $message=__METHOD__.':'.self::ERROR_UNABLE.PHP_EOL;
            $message.=strip_tags($filename).PHP_EOL;
            throw  new Exception($message);
        }
        $this->log=new SplFileObject($filename,'r');

    }
    // 生成器
    public function fileIteratorByLine(){
        $count=0;
        while (!$this->log->eof()){
            yield $this->log->fgets();
            $count++;
        }
        return $count;
    }
    // 执行查找操作
    public function getIp($line){
        preg_match_all('/(\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3})/',$line,$match);
        return $match[1]??'';
    }



}
