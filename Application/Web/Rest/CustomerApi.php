<?php
/**
 * Create by ZhangShuo
 * Date: 2021/7/30
 * Time: 18:56
 * When you read this code, good luck for you.
 */

namespace Application\Web\Rest;


use Application\Database\Connection;
use Application\Database\CustomerService;
use Application\Web\Request;
use Application\Web\Response;

class CustomerApi extends  AbstractApi
{
    const ERROR='ERROR';
    const ERROR_NOT_DOUND='ERROR:Not Found';
    const SUCCESS_UPDATE='SUCCESS :UPDATE successed';
    const SUCCESS_DELETE='Success:delete successed';
    const ID_FIELD='id';
    const TOKEN_FIELD='token';
    const LIMIT_FIELD='offset';
    const DEFAULT_LIMIT='20';
    const DEFAULT_OFFSET=0;
    protected $service;
    public function __construct($registeredKeys, $dbparams=null,$tokenField=null)
    {
        parent::__construct($registeredKeys, $tokenField);
        $this->service=new CustomerService(new Connection($dbparams));
    }
    public function get(Request $request, Response $response)
    {
        $result=[];
        $id=$request->getDataByKey(self::ID_FIELD)??0;
        if ($id>0){
            $result=$this->service->fetchById($id)->entityToArray();
        }else{
            $limit=$request->getDataByKey(self::LIMIT_FIELD)??self::DEFAULT_LIMIT;
            $offset=$request->getDataByKey(self::DEFAULT_OFFSET)??self::DEFAULT_OFFSET;
            $result=[];
        }
        if ($result){
            $response->setData($result);
            $response->setStatus(Request::STATUS_200);
        }else{
            $response->setStatus(Request::STATUS_500);
            $response->setData([self::ERROR_NOT_DOUND]);
        }
    }

}
