<?php
/**
 * Create by ZhangShuo
 * Date: 2021/8/7
 * Time: 11:47
 * When you read this code, good luck for you.
 */

namespace Application\Middleware;

use RuntimeException;
use InvalidArgumentException;
use Psr\Http\Message\UploadedFileInterface;
use Exception;

class UploadedFile implements UploadedFileInterface
{
    protected $field;  // 上传文件原始名称
    protected $info; // 获取$_file 的值
    protected $randomize;
    protected $movedName = '';
    protected $stream;
    protected $moved=true;

    public function __construct($field,array $info,$randomize=false)
    {
        $this->field=$field;
        $this->info=$info;
        $this->randomize=$randomize;
    }
    public function getStream()
    {
        if (!$this->stream){
            if ($this->movedName){
                $this->stream=new Stream($this->movedName);
            }else{
                $this->stream=new Stream($this->info['tmp_name']);
            }
        }
        return $this->stream;
    }
    public function moveTo($targetPath)
    {
      if (!$this->moved){
          throw new Exception(Constants::ERROR_BAD.'ready moved');
      }
      if (!file_exists($targetPath)){
          throw new InvalidArgumentException(Constants::ERROR_BAD.'BAD DIR Path');
      }
      $tempFile=$this->info['tmp_name']??false;
      if (!$tempFile||!file_exists($tempFile)){
          throw new Exception(Constants::ERROR_BAD.'FILE NOT EXIST');
      }
      if (!is_uploaded_file($tempFile)){
          throw new Exception('file  not  upload');
      }
      if ($this->randomize){
          $fanal=bin2hex(random_bytes(8).'txt');
      }else{
          $fanal=$this->info['name'];
      }
      $fanal=$targetPath.'/'.$fanal;
      $fanal=str_replace('//','/',$fanal);
      if (!move_uploaded_file($tempFile,$fanal)){
          throw new Exception('moved fail');
      }
      $this->movedName=$fanal;
      return true;
    }
    public function getMovedName(){
        return $this->movedName??null;
    }
    public function getSize()
    {
        return $this->info['size']??null;
    }
    public function getError()
    {
       return $this->info['error'];
    }
    public function getClientFilename()
    {
        return $this->info['name']??null;
    }
    public function getClientMediaType()
    {
       return $this->info['type']??null;
    }


}
