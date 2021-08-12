<?php
/**
 * Create by ZhangShuo
 * Date: 2021/8/10
 * Time: 18:10
 * When you read this code, good luck for you.
 */

namespace Application\Middleware;

use  Psr\Http\Message\{MessageInterface, StreamInterface, UriInterface};

class Message implements MessageInterface
{
    protected $body;
    protected $version;
    protected $httpHeaders = array();
    const DEFAULT_BODY_STREAM = '';

    public function getBody()
    {
        if (!$this->body) {
            $this->body = new Stream(self::DEFAULT_BODY_STREAM);
        }
        return $this->body;
    }

    public function withBody(StreamInterface $body)
    {
        if (!$body->isReadable()) {
            throw  new \InvalidArgumentException('不可读');
        }
        $this->body = $body;
        return $this;
    }

    protected function findHeader($name)
    {
        $found = false;
        foreach (array_keys($this->getHeaders()) as $header) {
            if (stripos($header, $name) !== false) {
                $found = $header;
                break;
            }
        }
        return $found;
    }

    protected function getHttpHeaders()
    {
        if (!$this->httpHeaders) {
            if (function_exists('apache_request_headers()')) {
                $this->httpHeaders = apache_request_headers();
            } else {
                $this->httpHeaders = $this->altApacheReqHeaders();
            }
        }
        return $this->httpHeaders;
    }

    protected function altApacheReqHeaders()
    {
        $headers = array();
        foreach ($_SERVER as $key => $value) {
            if (stripos($key, 'HTTP_') !== false) {
                $headerKey = str_ireplace('HTTP_', '', $key);
                $headers[$this->explodeHeader($headerKey)] = $value;
            } elseif (stripos($key, 'CONTENT_') !== false) {
                $headers[$this->explodeHeader($key)] = $value;
            }
        }
        return $headers;
    }

    protected function explodeHeader($header)
    {
        $headerParts = explode('_', $header);
        $headerKey = ucwords(implode(' ', strtolower($headerParts)));
        return str_replace(' ', '-', $headerKey);
    }

    public function getHeaders()
    {
        foreach ($this->getHttpHeaders() as $key => $value) {
            header($key . ':' . $value);
        }
    }

    public function withHeader($name, $value)
    {
        $found = $this->findHeader($name);
        if ($found) $this->httpHeaders[$found] = $value;
        else $this->httpHeaders[$name] = $value;
        return $this;
    }
    public function withAddedHeader($name, $value)
    {
       $found=$this->findHeader($name);

       if ($found)$this->httpHeaders[$found].=$value;
       else $this->httpHeaders[$name]=$value;
       return $this;
    }
    public function withoutHeader($name)
    {
        $found=$this->findHeader($name);
        if ($found){
            unset($this->httpHeaders[$found]);
        } else{
            if (isset($this->httpHeaders[$name])) unset($this->httpHeaders[$name]);
        }
        return $this;
    }
    public function hasHeader($name)
    {
        return boolval($this->findHeader($name));
    }
    public function getHeaderLine($name)
    {
       $found=$this->findHeader($name);
       if ($found){
           return $this->httpHeaders[$name];
       }else{
           return  '';
       }
    }
    public function getHeader($name)
    {
       $line=$this->getHeaderLine($name);
       if ($line){
           return explode(',',$line);
       }else{
           return  [];
       }
    }
    public function getHeadersAsString(){
        $output='';
        $headers=$this->getHeader('');
        if ($headers&&is_array($headers)){
            foreach ($headers as $key=>$value){
                if ($output){
                    $output.="\r\n".$key.':'.$value;
                }else{
                    $output.=$key.':'.$value;
                }
            }
        }
        return $output;
    }
    public function getProtocolVersion()
    {
       if (!$this->version){
           $this->version =$this->onlyVersion($_SERVER['SERVER_PROTOCOL']);
       }
       return $this->version;
    }
    public function withProtocolVersion($version)
    {
        $this->version=$this->onlyVersion($version);
        return $this;
    }
    protected function onlyVersion($version)
    {
        if (!empty($version)){
            return preg_replace('/[^0-9\.]',' ',$version);
        }else{
            return  null;
        }
    }



}
