<?php
/**
 * Create by ZhangShuo
 * Date: 2021/7/30
 * Time: 14:31
 * When you read this code, good luck for you.
 */

namespace Application\Web\Client;

use Application\Web\{Received, Request};

class Streams
{
    const BYTES_TO_READ = 4096;

    public static function send(Request $request)
    {
        $data = $request->getData();
        $received = new Received();
        switch ($request->getMethod()) {
            case Request::METHOD_GET:
                if ($data) {
                    $request->setUri($request->getUri() . '?' . $request->getDataEncode());
                }
                $resource = fopen($request->getUri(), 'r');
                break;
            case Request::METHOD_POST:
                $opts = [
                    $request->getTransport() => ['method' => Request::METHOD_POST, 'header' => Request::HEADER_CONTENT_TYPE . ':' . Request::CONTENT_TYPE_FORM_URL_ENCODED, 'content' => $data]
                ];
                $resource = fopen($request->getUri(), 'w', stream_context_create($opts));
                break;
        }
        return self::getResults($received, $resource);
    }

    public static function getResults(Received $received, $resource)
    {
        $received->setMetaDate(stream_get_meta_data($resource));
        $data = $received->getMetaDateByKey('wrapper_data');
        if (!empty($data) && is_array($data)) {
            foreach ($data as $item) {
                if (preg_match('!^HTTP/\d\.\d (\d+?) .*?$!', $item, $matches)){
                $received->setHeadersByKey('status',$matches[1]);
                } else{
                    list($key,$value)=explode(':',$item);
                    $received->setHeadersByKey($key,$value);
                   // $received->setHeadersByKey('status',200);
                }
            }
        }
        $payload='';
        while (!feof($resource)){
            $payload.=fread($resource,self::BYTES_TO_READ);
        }
        if ($received->getHeadersByKey(Received::HEADER_CONTENT_TYPE)){
            $received->setData(json_decode($payload));
//            switch (true){
//                case stripos($received->getHeadersByKey(Received::HEADER_CONTENT_TYPE),Received::CONTENT_TYPE_JSON)!==false:
//                    $received->setData(json_decode($payload));
//                    break;
//                default:
//                    $received->setData($payload);
//                    break;
//            }
        };
        return $received;
    }
}
