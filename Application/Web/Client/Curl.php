<?php
/**
 * Create by ZhangShuo
 * Date: 2021/7/30
 * Time: 15:45
 * When you read this code, good luck for you.
 */

namespace Application\Web\Client;
use Application\Web\{Request,Received};

class Curl
{
    public static function send(Request $request)
    {
        $data=$request->getDataEncode();
        $received=new Received();
        switch ($request->getMethod()){
            case Request::METHOD_GET:
                $uri=($data)?$request->getUri().'?'.$data:$request->getUri();
                $option=[
                    CURLOPT_URL=>$uri,
                    CURLOPT_HEADER=>0,
                    CURLOPT_RETURNTRANSFER=>true,
                    CURLOPT_TIMEOUT=>4
                ];
                break;
            case Request::METHOD_POST:
                $option=[
                  CURLOPT_POST=>1,
                  CURLOPT_HEADER=>0,
                  CURLOPT_URL=>$request->getUri(),
                  CURLOPT_FRESH_CONNECT=>1,
                  CURLOPT_RETURNTRANSFER=>1,
                  CURLOPT_FORBID_REUSE=>1,
                  CURLOPT_TIMEOUT=>1,
                  CURLOPT_POSTFIELDS=>$data
                ];
                break;
        }
        $ch=curl_init();
        curl_setopt_array($ch,($option));
        if (!$result=curl_exec($ch)){
            trigger_error(curl_error($ch));
        };
        $received->setMetaDate(curl_getinfo($ch));
        curl_close($ch);
        return self::getResults($received,$result);

    }
    public static function getResults(Received $received,$payload)
    {
        $type=$received->getMetaDateByKey('content_type');
        $received->setData(json_decode($payload));
//        if ($type){
//            switch (true){
//                case  stripos($type,Received::CONTENT_TYPE_JSON)!==false||:
//                    $received->setData(json_decode($payload));
//                    break;
//                default:
//                    $received->setData($payload);
//                    break;
//            }
//        }
        return $received;
    }


}
