<?php
/**
 * Create by ZhangShuo
 * Date: 2021/7/22
 * Time: 13:58
 * When you read this code, good luck for you.
 */

namespace Application\generic;

use PDO;
trait ListTraitTest
{
    public function list(){
        $list =[];
        $sql=sprintf('select %s,%sfrom %s',$this->key,$this->value,$this->table);
        $stmt=$this->connection->pdo->query($sql);
        while ($item=$stmt->fetch(PDO::FETCH_ASSOC)){
            $list[$item[$this->key]]=$item[$this->value];
        }
        return $list;
    }

}
