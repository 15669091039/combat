<?php
/**
 * Create by ZhangShuo
 * Date: 2021/7/21
 * Time: 16:16
 * When you read this code, good luck for you.
 */

namespace Application\chap04;


use Application\Database\Connection;

class ListFactory
{
    public static function factory(ConnectAwareInterface $class,$dbparams){
        if ($class instanceof ConnectAwareInterface){
            $class->setConnection(new Connection($dbparams));
            return $class;
        }else{
            throw  new \Exception('class wrong');
        }
    }

}
