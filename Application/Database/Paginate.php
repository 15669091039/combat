<?php
/**
 * Create by ZhangShuo
 * Date: 2021/7/23
 * Time: 10:17
 * When you read this code, good luck for you.
 */

namespace Application\Database;


use function Couchbase\basicEncoderV1;

class Paginate
{
    const DEFAULT_LIMIT = 20;
    const DEFAULT_OFFSET =0;
    protected  $sql;
    protected  $page;
    protected  $linesPerPage;
    public function __construct($sql,$page,$linesPerPage,$limit=self::DEFAULT_LIMIT,$offset=self::DEFAULT_OFFSET)
    {
        $offset=$page*$linesPerPage;
        switch (TRUE){
            case (stripos($sql,'limit')&&stripos($sql,'offset')):
                break;
            case (stripos($sql,'limit')):
                $sql.=' limit '.self::DEFAULT_LIMIT;
                break;
            case (stripos($sql,'offset')):
                $sql.= ' offset '.self::DEFAULT_OFFSET;
                break;
            default:
                $sql.=' limit '.self::DEFAULT_LIMIT;
                $sql.= ' offset '.self::DEFAULT_OFFSET;
                break;
        }
        $this->sql=preg_replace('/limit \d+.*OFFSET \d+/Ui',' limit '.$linesPerPage.' offset '.$offset,$sql);




    }
    public function paginate(Connection $connection){

    }


}
