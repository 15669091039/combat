<?php
/**
 * Create by ZhangShuo
 * Date: 2021/8/4
 * Time: 11:00
 * When you read this code, good luck for you.
 */

namespace Application\Acl;


use Application\Database\Connection;
use Application\Middleware\Response;
use Application\Middleware\TextStream;
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
       $params=json_decode($request->getBody()->getContents());
       $response=new Response();
       $username=$params->username??false;
       if ($username){
           $sql='select * from '.$this->table.' where email=?';
           $stmt=$this->conn->pdo->prepare($sql);
           $stmt->execute([$username]);
           $row=$stmt->fetch(\PDO::FETCH_ASSOC);
           if($row){
               if (password_verify($params->password,$row['password'])){
                   unset($row['password']);
                   $body=new TextStream(json_encode($row));
                   $response->withBody($body);
                   $code=202;
                   $info=$row;
               }
           }
       }
       return  $response->withBody($body)->withStatus($code);
    }

}
