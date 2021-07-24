<?php
/**
 * Create by ZhangShuo
 * Date: 2021/7/22
 * Time: 14:02
 * When you read this code, good luck for you.
 */

namespace Application\generic;




use Application\Database\{ConnectAwareInterface,Connection};

class CountryListUsingTrait  implements ConnectAwareInterface
{
    use ListTrait;
    protected $connection;
    protected  $key='id';
    protected  $value='name';
    protected $table='user_examiner_teacher';
    public function setConnection(Connection $connection)
    {
        $this->connection=$connection;
        // TODO: Implement setConnection() method.
    }

}
