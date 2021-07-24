<?php
/**
 * Create by ZhangShuo
 * Date: 2021/7/24
 * Time: 10:54
 * When you read this code, good luck for you.
 */

namespace Application\Database;


use Application\Entity\Customer;

class CustomerService
{
    protected $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function fetchById($id)
    {
        $stmt = $this->connection->pdo->prepare(Finder::select('customer')->where('id=:id')::getSql());
        $stmt->execute(['id' => $id]);
        return Customer::arrayToEntity($stmt->fetch(\PDO::FETCH_ASSOC), new Customer());

    }

    public function fetchByLevel($level)
    {
        $stmt = $this->connection->pdo->prepare(Finder::select('customer')->where('level=:level')::getSql());
        $stmt->execute(['level' => $level]);
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            yield Customer::arrayToEntity($row, new Customer());
        }
    }

    public function fetchByEmail($email)
    {
        $stmt = $this->connection->pdo->prepare(Finder::select('customer')->where('email=:email')::getSql());
        $stmt->execute(['email' => $email]);
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            yield Customer::arrayToEntity($row, new Customer());
        }
    }

    public function save(Customer $cust)
    {
        // 检查客户id是否大于0 ，以及客户记录是否存在
        if ($cust->getId() && $this->fetchById($cust->getId())) {
            return $this->doUpdate($cust);
        } else {
            return $this->doInstance();
        }
    }


}
