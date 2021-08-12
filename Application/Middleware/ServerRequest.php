<?php
/**
 * Create by ZhangShuo
 * Date: 2021/8/12
 * Time: 15:53
 * When you read this code, good luck for you.
 */

namespace Application\Middleware;


use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\UploadedFileInterface;

class ServerRequest  extends Request implements ServerRequestInterface
{
    protected $serverParams;
    protected $cookies;
    protected $queryParams;
    protected $contentType;
    protected $parseBody;
    protected $attributes;
    protected $method;
    protected $uploadedFileInfo;
    protected $uploadedFileObjs;
    public function getServerParams()
    {
       if (!$this->serverParams){
           $this->serverParams=$_SERVER;
       }
       return $this->serverParams;
    }
    public function getCookieParams()
    {
       if (!$this->cookies){
           $this->cookies=$_COOKIE;
       }
       return $this->cookies;
    }
    public function getQueryParams()
    {
        if (!$this->queryParams){
            $this->queryParams=$_GET;
        }
        return $this->queryParams;
    }
    public function getUploadedFileInfo()
    {
        if (!$this->uploadedFileInfo){
            $this->uploadedFileInfo=$_FILES;
        }
        return $this->uploadedFileInfo;
    }
    public function getRequestMethod(){
        $method=$this->getServerParams()['REQUEST_METHOD']??'';
        $this->method=strtolower($method);
        return $this->method;
    }
    public function getContentType()
    {
        if (!$this->contentType){
            $this->contentType=strtolower($this->getServerParams()['CONTENT_TYPE']?? ' ');
        }
        return  $this->contentType;
    }
    public function getUploadedFiles()
    {
        if (!$this->uploadedFileObjs){
            foreach ( $this->getUploadedFileInfo() as $field=>$value){
                $this->uploadedFileObjs[$field]=new UploadedFile($field,$value);
            }
        }
        return $this->uploadedFileObjs;
    }
    public function withCookieParams(array $cookies)
    {
        array_merge($this->getCookieParams(),$cookies);
        return $this;
    }
    public function withQueryParams(array $query)
    {
        array_merge($this->getQueryParams(),$query);
        return $this;
    }

    public function withUploadedFiles(array $uploadedFiles)
    {
        if (!count($uploadedFiles)){
            throw  new \InvalidArgumentException('错误， 没有上传文件');
        }
        foreach ($uploadedFiles as $fileObjs){
            if (!$fileObjs instanceof  UploadedFileInterface){
                throw new \InvalidArgumentException('上传类型错误');
            }
        }
        $this->uploadedFileObjs=$uploadedFiles;
    }
    public function getParsedBody()
    {
        if (!$this->parseBody){
            if (($this->getContentType()==Constants::CONTENT_TYPE_FORM_ENCODED||$this->getContentType()==Constants::CONTENT_TYPE_MULTI_FORM)&&$this->getRequestMethod()==Constants::METHOD_POST){
                $this->parseBody=$_POST;
            }elseif ($this->getContentType()==Constants::CONTENT_TYPE_JSON||$this->getContentType()==Constants::CONTENT_TYPE_HAL_JSON){
                ini_set('allow_url_fopen',true);
                $this->parseBody=json_decode(file_get_contents('php://input'));
            }elseif (!empty($_REQUEST)){
                $this->parseBody=$_REQUEST;
            }else{
                ini_set('allow_url_fopen',true);
                $this->parseBody=file_get_contents('php://input');
            }
        }
        return $this->parseBody;
    }
    public function withParsedBody($data)
    {
       $this->parseBody=$data;
       return $this;
    }
    public function getAttributes()
    {
       return $this->attributes;
    }

    public function getAttribute($name, $default = null)
    {
        return $this->attributes[$name]??$default;
    }
    public function withAttribute($name, $value)
    {
       $this->attributes[$name]=$value;
    }
    public function withoutAttribute($name)
    {
        if (isset($this->attributes[$name])){
            unset($this->attributes[$name]);
        }
        return $this;
    }
    public function initialize(){
        $this->getServerParams();
        $this->getCookieParams();
        $this->getQueryParams();
        $this->getUploadedFiles();
        $this->getRequestMethod();
        $this->getContentType();
        $this->getParsedBody();
        return $this;
    }



}
