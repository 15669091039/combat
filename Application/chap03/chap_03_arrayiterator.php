<?php
/**
 * Create by ZhangShuo
 * Date: 2021/7/19
 * Time: 16:35
 * When you read this code, good luck for you.
 */
// 迭代器


//$array=[666,777];
//$s=new ArrayIterator($array);

function convert($size)
{
    $unit=array('b','kb','mb','gb','tb','pb');
    return @round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i];
}
$file='./server_2.log';
//$startMemory = memory_get_usage();
//function getContents($file){
//    $fileContent=new SplFileObject($file);
//    $count=0;
//    while (!$fileContent->eof()){
//
//        yield $fileContent->fgets();
//        $count++;
//    }
//    return $count;
//}
//$start_time=microtime(true);//获取程序执行开始的时间
//$res=getContents($file);
//foreach ($res as $val){
//    $s=$val;
//}
//echo  $res->getReturn().'<br>';
//$end_time=microtime(true);//获取程序执行结束的时间
//$elapse=$end_time-$start_time; //获取差值
//$endMemory = memory_get_usage();
//$useMemory = $endMemory-$startMemory;
//echo "总共占用的内存大小为:".convert($useMemory)."</br>";
//echo "第一种消耗时间".$elapse."</br>";  //此处设一个计时器 结束时间

//
$file_path = $file; //文件路径  此处找一个1094644行的TXT文件 test.txt
$startMemory = memory_get_usage();
set_time_limit(0);
$start_time=microtime(true);//获取程序执行开始的时间
$fileContent=file($file_path);
$num=0;
foreach ($fileContent as $val){
    $s=$val;
    $num++;
}
$line = count($fileContent);
//输出行数；
echo $num."</br>";
$end_time=microtime(true);//获取程序执行结束的时间
$elapse=$end_time-$start_time; //获取差值
$endMemory = memory_get_usage();
$useMemory = $endMemory-$startMemory;
echo "总共占用的内存大小为:".convert($useMemory)."</br>";
echo "第二种消耗时间".$elapse."</br>";  //此处设一个计时器 结束时间


//
//$file_path = $file; //文件路径  此处找一个1094644行的TXT文件 test.txt
//$line = 0 ; //初始化行数
////打开文件
//set_time_limit(0);
//$start_time=microtime(true);//获取程序执行开始的时间
//$fp = fopen($file_path , 'r') or die("open file failure!");
//if($fp){
////获取文件的一行内容，注意：需要php5才支持该函数；
//    while(stream_get_line($fp,8192,"\n")){
//        $line++;
//    }
//    fclose($fp);//关闭文件
//}
////输出行数；
//echo $line."</br>";
//$end_time=microtime(true);//获取程序执行结束的时间
//$elapse=$end_time-$start_time; //获取差值
//echo "第三种消耗时间".$elapse."</br>";  //此处设一个计时器 结束时间
