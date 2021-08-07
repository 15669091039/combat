<?php
/**
 * Create by ZhangShuo
 * Date: 2021/8/7
 * Time: 11:33
 * When you read this code, good luck for you.
 */

namespace Application\Middleware;

use Throwable;
use RuntimeException;
use SplFileInfo;
use Psr\Http\Message\StreamInterface;

class TextStream implements StreamInterface
{
    protected $stream;
    protected $pos = 0;

    public function __construct(string $input)
    {
        $this->stream=$input;
    }
    public function getStream(){
        return $this->stream;
    }
    public function getInfo(){
        return null;
    }
    public function getContents()
    {
        return $this->stream;
    }
    public function __toString()
    {
        return $this->getContents();
    }
    public function getSize()
    {
        return strlen($this->stream);
    }
    public function close()
    {

    }
    public function detach()
    {

    }
    public function tell()
    {
       return $this->pos;
    }
    public function eof()
    {
       return $this->pos==strlen($this->stream);
    }
    public function isSeekable()
    {
       return true;
    }
    public function seek($offset, $whence = SEEK_SET)
    {
        if ($offset<$this->getSize()){
            $this->pos=$offset;
        }else{
            throw new RuntimeException(Constants::ERROR_BAD.__METHOD__);
        }
    }
    public function rewind()
    {
        $this->pos=0;
    }
    public function isWritable()
    {
        return true;
    }
    public function isReadable()
    {
        return true;
    }
    public function write($string)
    {
        $this->stream=$string;
    }
    public function read($length)
    {
       return substr($this->stream,$this->pos,$length);
    }
    public function getMetadata($key = null)
    {
        return null;
    }


}
