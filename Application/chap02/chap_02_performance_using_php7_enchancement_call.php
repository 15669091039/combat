<?php
/**
 * Create by ZhangShuo
 * Date: 2021/7/14
 * Time: 13:55
 * When you read this code, good luck for you.
 */
define('LOG_FILES','./serverlog.logbak');
include '../Autoload/Loader.php';
\Application\Autoload\Loader::init(__DIR__.'/../..');
$freq=function ($line) {
    $ip =$this->getIp($line);
  if ($ip){
      if (is_array($ip)){
          foreach ($ip as $value){
              echo '.';
              $this->frequency[$value]=(isset($this->frequency[$value]))?$this->frequency[$value]+1:1;
          }
      }


  }
};
foreach (glob(LOG_FILES) as $server){
    echo '<br>'.$server.'<br>';
    $access=new \Application\Web\Access($server);
    foreach ($access->fileIteratorByLine() as $line){
        $freq->call($access,$line);
    }
}
asort($access->frequency);
foreach ($access->frequency as $key=>$value){
    printf('%16s:%6d'.'<br>',$key,$value);
}
