<?php
/**
 * Create by ZhangShuo
 * Date: 2021/8/12
 * Time: 17:21
 * When you read this code, good luck for you.
 */
include '../Autoload/Loader.php';
\Application\Autoload\Loader::init(__DIR__ . '/../..');
use  Application\Middleware\{Constants,ServerRequest,Response,Stream};
$data=[
    1=>'666.log',
    2=>'ddd.txt',
    3=>'sdsad.txt'
];
$body=[];
try {
    $body['text']='Initial State';
    $request=new ServerRequest();
    $request->initialize();
    $tempFile=bin2hex(random_bytes(8)).'.txt';
    $code=200;
    if ($request->getMethod()==Constants::METHOD_GET){
        $id=$request->getQueryParams()['id']??null;
        $id=(int)$id;
        if ($id&&$id<count($data)){
//            ini_set('display_errors',1);
//            ini_set('error_reporting',-1);
           if (file_exists(__DIR__.'/'.$data[$id]))
            $body['text']=file_get_contents(__DIR__.'/'.$data[$id]);
           else  $body['text']=$data;
        }else{
            $body['text']=$data;
        }
    }elseif($request->getMethod()==Constants::METHOD_POST){
        $size=$request->getBody()->getSize();
        $body['text']=$size.'bytes of data received';
        if ($size) $code=201;else $code=204;
    }

}catch (Throwable $e){
    $code=500;
    $body['text']='error:'.$e->getMessage();
}
try {
    file_put_contents($tempFile,json_encode($body));
    $body=new Stream($tempFile);
    $header[Constants::HEADER_CONTENT_TYPE]='application/json';
    $header[Constants::HEADER_CONTENT_TYPE]='text/html';
    $response =new Response($code,$body,$header);
    $response->getHeaders();
    echo $response->getBody()->getContents();
//    var_dump($response);
}catch (Throwable $e){
    echo $e->getMessage();
}finally{
//    unlink($tempFile);
}
