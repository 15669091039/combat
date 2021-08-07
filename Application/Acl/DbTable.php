<?php
/**
 * Create by ZhangShuo
 * Date: 2021/8/4
 * Time: 11:00
 * When you read this code, good luck for you.
 */

namespace Application\Acl;
require '../../vendor/autoload.php';

use Application\Database\Connection;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class DbTable  implements AuthenticateInterface
{
    const ERROR_AUTH ='ERROR: authentication error ';
    protected $conn;
    protected $table;
    public function __construct(Connection $conn,$tableName){
        $this->conn=$conn;
        $this->table=$tableName;
    }
    public function login(RequestInterface $request): ResponseInterface
    {
       $code=401;
       $info=false;
       $body=new TextStream(self::ERROR_AUTH);
       $params=json_decode($request->getBody()->getContent);
    }

}
