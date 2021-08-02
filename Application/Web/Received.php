<?php
/**
 * Create by ZhangShuo
 * Date: 2021/7/30
 * Time: 14:21
 * When you read this code, good luck for you.
 */

namespace Application\Web;


class Received extends AbstractHttp
{
    public function __construct($uri = null, $method = null, array $headers = [], array $data = null, array $cookies = null)
    {
        $this->uri = $uri;
        $this->method=$method;
        $this->headers=$headers;
        $this->data=$data;
        $this->cookies=$cookies;
        $this->setTransport();
    }



}
