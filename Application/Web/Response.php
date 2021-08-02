<?php
/**
 * Create by ZhangShuo
 * Date: 2021/7/30
 * Time: 17:41
 * When you read this code, good luck for you.
 */

namespace Application\Web;


class Response  extends AbstractHttp
{
    protected $status=401;
    public function __construct(Request $request=null,$status=null,$contentType=null)
    {
        if ($request){
            $this->uri=$request->getUri();
            $this->data=$request->getData();
            $this->method=$request->getMethod();
            $this->cookies=$request->getCookies();
            $this->setTransport();
        }
        $this->processHeaders($contentType);
        if ($status){
            $this->setStatus($status);
        }
    }
    protected function processHeaders($contentType){
        if (!$contentType){
            $this->setHeadersByKey(self::HEADER_CONTENT_TYPE,self::CONTENT_TYPE_JSON);
        }else{
            $this->setHeadersByKey(self::HEADER_CONTENT_TYPE,$contentType);
        }
    }

    public function setStatus($status)
    {
        $this->status=$status;
    }
    public function getStatus()
    {
        return $this->status;
    }


}
