<?php
/**
 * Create by ZhangShuo
 * Date: 2021/7/14
 * Time: 13:55
 * When you read this code, good luck for you.
 */
define('LOG_FILES','./serverlog.log');
include '../Autoload/Loader.php';
\Application\Autoload\Loader::init(__DIR__.'/../..');
try {
    $largeFile=new \Application\Iterator\File(LOG_FILES);
    $iterator=$largeFile->getIterator();
    $word =0;
    foreach ($iterator  as $val){
        echo $val;
        $word +=str_word_count($val);
    }
    echo  str_repeat('-',52);
    printf('%-40s:%8d\n','total Words',$word);
    printf('%-40s:%8d\n','Average Words Per Line',($word/$iterator->getReturn()));
    echo  str_repeat('-',52);
}catch (Throwable $e){
    echo  $e->getMessage();

}


