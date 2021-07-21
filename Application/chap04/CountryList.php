<?php
/**
 * Create by ZhangShuo
 * Date: 2021/7/21
 * Time: 15:36
 * When you read this code, good luck for you.
 */

namespace Application\chap04;


use Application\Database\Connection;

class CountryList implements ConnectAwareInterface
{
    protected $connection;
    public function setConnection(Connection $connection)
    {
        // TODO: Implement setConnection() method.
        $this->connection=$connection;
    }
    public function list(){
        $list =[];
        $stmt=$this->connection->pdo->query('select * from user_examiner_teacher');
        while ($country=$stmt->fetch(PDO::FETCH_ASSOC)){
            $list[$country['id']]=$country['name'];
        }
        return $list;
    }


}
