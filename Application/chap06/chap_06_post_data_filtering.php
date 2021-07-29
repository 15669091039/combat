<?php
/**
 * Create by ZhangShuo
 * Date: 2021/7/28
 * Time: 17:40
 * When you read this code, good luck for you.
 */
include '../Autoload/Loader.php';
\Application\Autoload\Loader::init(__DIR__ . '/../..');
include './chap_06_data_config_callbacks.php';
include './chap_06_post_data_config_message.php';

$assignments=[
    '*'=>[['key'=>'trim','params'=>[]],['key'=>'strip_tags','params'=>[]]],
    'first_name'=>[['key'=>'length','params'=>['length'=>128]]],
    'last_name'=>[['key'=>'length','params'=>['length'=>128]]],
    'city'=>[['key'=>'length','params'=>['length'=>64]]],
    'budget'=>[['key'=>'filter_float','params'=>[]]],
];

$goodData=[
    'first_name'=>"Your <script>Full</script>",
    'last_name'=>'Name',
    'address'=>'123 Main Street',
    'city' =>'San Francisco',
    'state_province'=>' California ',
    'postal_code'=>' 94101 ',
    'phone'=>'+1 415-555-1212',
    'country'=>'US',
    'email'=>'your@email.address.com',
    'budget'=>'123.45',

];
$badData=[
    'first_name'=>'Your<div> Full</div>',
    'last_name'=>'Name',
   // 'address'=>'123 Main Street',
    'city' =>'San Franciscodsadsadasdasdhaquiogasdifiuasdgfhsdgfszgoyfgspiudfhdpshfkpjsdhf[lksdhfoidhsopiufhsduipohfdasd',
    //'state_province'=>'California',
    'postal_code'=>'94101',
    'phone'=>'123456',
    'country'=>'US',
    'email'=>'your@email.address.com',
    'budget'=>'xxx',

];



$filter=new \Application\Filter\Filter($config['filters'],$assignments);
$filter->setSeparator('<br>');
$filter->process($goodData);
echo $filter->getMessageString();
var_dump($filter->getItemsAsArray());



//
//$filter->process($badData);
//echo $filter->getMessageString();
//var_dump($filter->getItemsAsArray());




