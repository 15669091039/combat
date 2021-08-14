<?php
/**
 * Create by ZhangShuo
 * Date: 2021/8/14
 * Time: 11:24
 * When you read this code, good luck for you.
 */
use Application\Database\Connection;
use Application\Acl\DbTable;
use Application\Acl\Authenticate;
$conn=new Connection(include DB_CONFIG_FILE);
$dbAuth=new DbTable($conn,DB_TABLE);
$auth=new Authenticate($dbAuth,SESSION_KEY);



