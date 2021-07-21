<?php
/**
 * Create by ZhangShuo
 * Date: 2021/7/21
 * Time: 15:32
 * When you read this code, good luck for you.
 */

namespace Application\Database;


use Application\Database\Connection;

interface ConnectAwareInterface
{
    public function setConnection(Connection $connection);

}
