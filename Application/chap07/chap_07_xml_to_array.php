<?php
/**
 * Create by ZhangShuo
 * Date: 2021/7/30
 * Time: 11:18
 * When you read this code, good luck for you.
 */

include '../Autoload/Loader.php';
\Application\Autoload\Loader::init(__DIR__ . '/../..');

use Application\Parse\ConvertXml;
$wsd1='http://www.oorsprong.org/websamples.countryinfo/countryinfoservice.wso?WSDL';
$xml=new SimpleXMLIterator($wsd1,0,true);
$convert=new ConvertXml();
echo  json_encode($convert->xmlToArray($xml));

