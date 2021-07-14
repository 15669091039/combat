<?php
/**
 * Create by ZhangShuo
 * Date: 2021/7/13
 * Time: 16:07
 * When you read this code, good luck for you.
 */
include '../Autoload/Loader.php';
\Application\Autoload\Loader::init(__DIR__.'/../..');
$security=new \Application\Web\Securityclass();
$data=[
    '<ul><li>Lots</li><li>OF</li><li>Tags</li></ul>'
    ,12345,
    'This is a string',
    'String with number 12345'
];
foreach ($data as $item){
    echo  'ORIGINAL: '.$item.PHP_EOL;
    echo  'FILTERING'.PHP_EOL;
    printf('%12s:%s'.PHP_EOL,'strip Tags',$security->filterStripTags($item));
    printf('%12s:%s'.PHP_EOL,'digits',$security->filterDigits($item));
    printf('%12s:%s'.PHP_EOL,'Alpha',$security->filterAlpha($item));
    echo  'VALIDATORS: '.PHP_EOL;
    printf('%12s:%s'.PHP_EOL,'Alpha',$security->filterAlpha($item));
}
