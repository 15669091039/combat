<?php
/**
 * Create by ZhangShuo
 * Date: 2021/7/14
 * Time: 15:32
 * When you read this code, good luck for you.
 */

namespace Application\Web;
use Exception;
use SplFileObject;
class File
{
    const   ERROR_UNABLE ='ERROR:UNABLE to  open file';
    protected $file;
    protected $allowedType='ERROR:Type must be "ByLength"';
    public function __construct($file){
        if (!file_exists($file)){
            $message=__METHOD__.':'.self::ERROR_UNABLE.PHP_EOL;
            $message.=strip_tags($file);
            throw  new Exception('file not exists');
        }
        $this->file=new SplFileObject($file);
    }
    //生成器
    public function fileIteratorByLine(){
        $count=0;
        while (!$this->file->eof()){
            yield $this->file->fgets();
            $count++;
        }
        return $count;
    }
    //生成器
    public function fileIteratorByLength($numberBytes=1024){
        $count=0;
        while (!$this->file->eof()){
            yield $this->file->fread($numberBytes);
            $count++;
        }
        return $count;
    }

}
