<?php
/**
 * Create by ZhangShuo
 * Date: 2021/7/30
 * Time: 11:38
 * When you read this code, good luck for you.
 */

namespace Application\Web;


abstract class AbstractHttp
{
    const METHOD_GET='GET';
    const METHOD_POST='POST';
    const METHOD_PUT='PUT';
    const METHOD_DELETE='DELETE';
    const CONTENT_TYPE_HTML='text/html';
    const CONTENT_TYPE_JSON='application/json';
    const CONTENT_TYPE_FORM_URL_ENCODED='application/x-www-form-urlencoded';
    const HEADER_CONTENT_TYPE='Content-Type';
    const TRANSPORT_HTTP='http';
    const TRANSPORT_HTTPS='https';
    const STATUS_200='200';
    const STATUS_401='401';
    const STATUS_500='500';

    protected $uri;
    protected $method;
    protected $headers;
    protected $cookies;
    protected $metaDate;
    protected $transport;
    protected $data=[];



    public function setMethod(string $method)
    {
        $this->method=$method;
    }
    public function getMethod(): string
    {
        return $this->method??self::METHOD_GET;
    }
    public function setHeaders($headers)
    {
        $this->headers=$headers;
    }
    public function setHeadersByKey($key,$header)
    {
        $this->headers[$key]=$header;
    }
    public function getHeadersByKey($key)
    {
        return $this->headers[$key]??null;
    }
    public function getHeaders()
    {
        return $this->headers;
    }
    public function setCookies($cookies)
    {
        $this->cookies=$cookies;
    }
    public function getCookies()
    {
        return $this->cookies;
    }
    public function setMetaDate($metaDate){
        $this->metaDate=$metaDate;
    }
    public function getMetaDate()
    {
        return $this->metaDate;
    }
    public function getMetaDateByKey($key)
    {
        return $this->metaDate[$key];
    }
    public function setTransport($transport=null){
        if ($transport){
            $this->transport=$transport;
        }else{
            if (substr($this->uri,0,5)==self::TRANSPORT_HTTPS){
                $this->transport=self::TRANSPORT_HTTPS;
            }else{
                $this->transport=self::TRANSPORT_HTTP;
            }
        }
    }
    public function getTransport(){
        return $this->transport;
    }
    public function setData($value){
        $this->data=$value;
    }
    public function setDataByKey($key,$value){
        $this->data[$key]=$value;
    }
    public function getData()
    {
        return $this->data;
    }
    public function getDataByKey($key)
    {
        return $this->data[$key]??null;
    }



    public function setUri(string $uri,array $params=null)
    {
        $this->uri=$uri;
        $first=true;
        if ($params){
            $this->uri.='?'.http_build_query($params);
        }
    }
    public function getUri()
    {
        return $this->uri;
    }


    public function getDataEncode(): string
    {
        return http_build_query($this->getData());
    }









}
