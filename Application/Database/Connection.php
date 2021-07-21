<?php
/**
 * Create by ZhangShuo
 * Date: 2021/7/21
 * Time: 10:31
 * When you read this code, good luck for you.
 */

namespace Application\Database;
use Exception;
use PDO;
/**
 * 数据库链接类
 *
 * 主要作用 ： 数据库链接查询，返回结果
 * Class Connection
 * @package Application\Database
 */
class Connection
{
    const ERROR_UNABLE ='ERROR:UNABLE TO CREATE DATABASE';
    public $pdo;
    public function __construct(array $config)
    {
        if (!isset($config['driver'])){
            $message=__METHOD__.':'.self::ERROR_UNABLE;
            throw new Exception($message);
        }
        $dsn=$config['driver'].':host='.$config['host'].';dbname='.$config['dbname'];
        try {
            $this->pdo=new PDO($dsn,$config['user'],$config['password'],[PDO::ATTR_ERRMODE=>$config['errmode']]);

        }catch (\PDOException $e){
            throw new Exception($e->getMessage());
            error_log($e->getMessage());
        }
    }



}
