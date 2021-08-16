<?php


namespace Application\Cache;

use MongoDB\BSON\Unserializable;
use PDO;
use Application\Database\Connection;
use Exception;
class Database  implements CacheAdapterInterface
{
    protected $sql;
    protected $connection;
    protected $table;
    protected $idColumnName;
    protected $dataColumnName;
    protected $keyColumnName;
    protected $groupColumnName;
    protected $statementHasKey=null;
    protected $statementGetFromCache=null;
    protected $statementRemoveBykey=null;
    protected $statementRemoveByGroup=null;
    protected $statementUpdateCache=null;
    protected $statementSaveCache=null;
    public function __construct(Connection $connection,$table,$idColumnName,$keyColumnName,$dataColumnName,$groupColumnName=Constants::DEFAULT_GROUP)
    {
        $this->connection=$connection;
        $this->setTable($table);
        $this->setIdColumnName($idColumnName);
        $this->setKeyColumnName($keyColumnName);
        $this->setDataColumnName($dataColumnName);
        $this->setGroupColumnName($groupColumnName);
    }
    public function setTable($table){
        $this->table=$table;
    }
    public function setIdColumnName($idColumnName)
    {
        $this->idColumnName=$idColumnName;
    }
    public function setKeyColumnName($keyColumnName){
        $this->keyColumnName=$keyColumnName;
    }
    public function setDataColumnName($dataColumnName)
    {
        $this->dataColumnName=$dataColumnName;
    }
    public function setGroupColumnName($groupColumnName){
        $this->groupColumnName=$groupColumnName;
    }
    public function prepareHasKey()
    {
        $sql='select `'.$this->idColumnName.'` from '.$this->table.' where '.$this->keyColumnName.' =:key';
        $this->sql[__METHOD__]=$sql;
        $this->statementHasKey=$this->connection->pdo->prepare($sql);
    }
    public function prepareGetFromCache()
    {
        $sql='select `'.$this->dataColumnName.'` from '.$this->table.' where '.$this->keyColumnName.' =:key and '.$this->groupColumnName.'=:group';
        $this->sql[__METHOD__]=$sql;
        $this->statementHasKey=$this->connection->pdo->prepare($sql);
    }

    public function prepareUpdateCache()
    {
        $sql='update '.$this->table.'set data=:data ,group=:group ,'.$this->idColumnName.'=:id where '.$this->keyColumnName.' = :key';
        $this->sql[__METHOD__]=$sql;
        $this->statementUpdateCache=$this->connection->pdo->prepare($sql);
    }
    public function prepareSaveCache()
    {
        $sql='insert into '.$this->table.' ('.$this->keyColumnName.',data,group) values (:key,:data,:group)';
        $this->sql[__METHOD__]=$sql;
        $this->statementSaveCache=$this->connection->pdo->prepare($sql);
    }

    public function hasKey($key)
    {
        try {
            if (!$this->statementHasKey)$this->prepareHasKey();
            $this->statementHasKey->execute(['key'=>$key]);
        }catch (\Throwable $e){
            error_log(__METHOD__.':'.$e->getMessage());
            throw new Exception(Constants::ERROR_CHECK_KEY);
        }
        return (int) $this->statementHasKey->fetch(PDO::FETCH_ASSOC)[$this->idColumnName];
    }
    public function getFromCache($key, $group=Constants::DEFAULT_GROUP)
    {
        try {
            if (!$this->statementGetFromCache)$this->prepareGetFromCache();
            $this->statementGetFromCache->execute(['key'=>$key,'group'=>$group]);
            while ($row=$this->statementGetFromCache->fetch(PDO::FETCH_ASSOC)){
                if ($row&&count($row)){
                    yield unserialize($row[$this->dataColumnName]);
                }
            }
        }catch (\Throwable $e){
            error_log(__METHOD__.':'.$e->getMessage());
            throw new Exception(Constants::ERROR_GET);
        }
    }

    public function saveToCache($key, $data, $group = Constants::DEFAULT_GROUP)
    {
        $id=$this->hasKey($key);
        $result=0;
        try {
            if ($id){
                if (!$this->statementUpdateCache)$this->prepareUpdateCache();
                $result= $this->statementUpdateCache->execute(['key'=>$key,'data'=>serialize($data),'group'=>$group,'id'=>$id]);
            }else{
                if (!$this->statementSaveCache)$this->prepareSaveCache();
                $result=$this->statementSaveCache->exectue(['key'=>$key,'data'=>serialize($data),'group'=>$group]);

            }
        }catch (\Throwable $e){
            error_log(__METHOD__.':'.$e->getMessage());
            throw new Exception(Constants::ERROR_CHECK_KEY);
        }
        return $result;
    }


}