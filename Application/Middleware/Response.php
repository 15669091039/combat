<?php
/**
 * Create by ZhangShuo
 * Date: 2021/8/12
 * Time: 16:54
 * When you read this code, good luck for you.
 */

namespace Application\Middleware;


use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class Response extends Message implements ResponseInterface
{

    protected  $status;
    public function __construct($statusCode=null,StreamInterface  $body=null,$header =null,$version=null)
    {
        $this->body=$body;
        $this->status['code']=$statusCode??Constants::DEFAULT_STATUS_CODE;
        $this->status['reason']=Constants::STATUS_CODES[$statusCode]??'';
        $this->httpHeaders=$header;
        $this->version=$this->onlyVersion($version);
        if ($statusCode) $this->setStatusCode();
    }
    public function setStatusCode(){
        http_response_code($this->getStatusCode());
    }
    public function getStatusCode()
    {
       return $this->status['code'];
    }
    public function withStatus($code, $reasonPhrase = '')
    {

        if (!isset(Constants::STATUS_CODES[$code])){
            throw  new \InvalidArgumentException('ERROR bad statusCode');
        }
        $this->status['code']=$code;
        $this->status['reason']=($reasonPhrase)?Constants::STATUS_CODES[$code]:null;
        $this->setStatusCode();
        return $this;
    }

    public function getReasonPhrase()
    {
        return $this->status['reason']??Constants::STATUS_CODES[$this->status['code']]??' ';
    }


}
