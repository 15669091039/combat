<?php
/**
 * Create by ZhangShuo
 * Date: 2021/7/19
 * Time: 10:05
 * When you read this code, good luck for you.
 */
declare(strict_types=1);
function getParams(...$args){
    return var_export($args,true);
}

function someDirScan($dir){
    static $list=[];
    $list=glob($dir.DIRECTORY_SEPARATOR.'*');
    foreach ($list as $item){
        if (is_dir($item)){
            $list=array_merge($list,someDirScan($item));
        }
    }
    return $list;
}

function someTypeHint(array $a,int $b,string $c):int{
    try {
        return 'ssss';
        //someTypeHint([],66,88);
    }catch (Throwable $e){
        echo  $e->getMessage();
        echo $e->getFile();
        echo $e->getLine();
        echo $e->getCode();
        die;
    } finally {

    }

}
echo  someTypeHint([],32,'55');





