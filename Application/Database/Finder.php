<?php
/**
 * Create by ZhangShuo
 * Date: 2021/7/22
 * Time: 18:36
 * When you read this code, good luck for you.
 */

namespace Application\Database;


class Finder
{
    public static $sql = '';
    public static $instance = null;
    public static $prefix = '';
    public static $where = [];
    public static $control = ['', ''];
    //  $a 表名称
    //  $prefix 字段名称
    public static function select($a, $cols = null)
    {
        self::$instance = new Finder();
        $cols = $cols ?? '*';
        self::$prefix = 'select ' . $cols . ' from ' . $a;
        return self::$instance;
    }
    // 查询条件
    public static function where($a=null){
        self::$where[0]=' where '.$a;
        return self::$instance;
    }
    public static function like($a,$b){
        self::$where[]=trim($a.' like '.$b);
        return self::$instance;
    }
    public static function and($a=null){
        self::$where[]=trim('and '.$a );
        return self::$instance;
    }
    public static function or($a=null){
        self::$where[]=trim(' or '.$a);
        return self::$instance;
    }
    public static function in(array $a){
        self::$where[]=trim(' in ('.implode(',',$a).' )');
        return self::$instance;
    }
    public static function not($a=null){
        self::$where[]=trim('not '.$a);
        return self::$instance;
    }
    public static function limit($limit){
        self::$control[0]='limit '.$limit;
        return self::$instance;
    }
    public static function offset($offset){
        self::$control[1]='offset '.$offset;
        return self::$instance;
    }
    public static function  getSql(){
        self::$sql=self::$prefix.' '.implode(' ',self::$where).' '.self::$control[0].' '.self::$control[1];
        preg_replace('/ /',' ',self::$sql);
        return trim(self::$sql);
    }



}
