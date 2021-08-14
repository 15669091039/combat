<?php
/**
 * Create by ZhangShuo
 * Date: 2021/8/14
 * Time: 11:37
 * When you read this code, good luck for you.
 */

$min=[0,'logout'];
return [
    'default'=>0,
    'levels'=>[0,'BEG','INT','ADV'],
    'pages'=>[
        0=>'sorry',
        'logout'=>'logout',
        'login'=>'auth',
        1=>'page1',
        2=>'page2',
        3=>'page3',
        4=>'page4',
    ],
    'allowed'=>[
        0=>['inherits'=>false,'pages'=>['*'=>$min,'BEG'=>$min,'INT'=>$min,'ADV'=>$min]],
        1=>['inherits'=>false,'pages'=>['*'=>$min,'BEG'=>[1,'logout'],'INT'=>[1,2,'logout'],'ADV'=>[1,2,3,'logout']]],
        2=>['inherits'=>1,'pages'=>['BEG'=>[4],'INT'=>[4,5],'ADV'=>[4,5,6]]],
        3=>['inherits'=>2,'pages'=>['BEG'=>[7],'INT'=>[7,8],'ADV'=>[7,8,9]]]

    ]

];
