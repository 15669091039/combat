<?php
/**
 * Create by ZhangShuo
 * Date: 2021/7/21
 * Time: 15:34
 * When you read this code, good luck for you.
 */

namespace Application\chap04;


use Application\Database\Connection;

class CustomerList implements ConnectAwareInterface
{
    protected $connection;
    public function setConnection(Connection $connection)
    {
        $this->connection=$connection;
        // TODO: Implement setConnection() method.
    }
    public function list(){
        $list =[];
        $stmt=$this->connection->pdo->query('select * from user_examiner_teacher');
        while ($customer=$stmt->fetch(PDO::FETCH_ASSOC)){
            $list[$customer['id']]=$customer['name'];
        }
        return $list;
    }


}
