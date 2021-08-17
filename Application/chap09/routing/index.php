<?php
session_start();
include '../../Autoload/Loader.php';

const DOC_ROOT = __DIR__;
const PAGE_DIR = DOC_ROOT . '/../pages';

use  Application\Middleware\ServerRequest;
use Application\Routing\Router;

$config = [
    'home' => [
        'uri' => '!^/index.php/(/|/home)$!',
        'exec' => function ($matches) {
            include PAGE_DIR . '/page1.php';
        }
    ],
    'page' => [
        'uri' => '!^/index.php/(page)/(\d+)(/?)$!',
        'exec' => function ($matches) {
            include PAGE_DIR . '/page'.$matches[2].'.php';
        }
    ],
    Router::DEFAULT_MATCH => [
        'uri' => '!.*!',
        'exec' => function ($matches) {
            include PAGE_DIR . '/menu.php';
        }
    ]
];


$router=new Router((new ServerRequest())->initialize(),DOC_ROOT,$config);
$execute=$router->match();
$params=$router->getRouteMatch()['match'];
if ($fn=$router->isFileOrDir()&&$router->getRequest()->getUri()->getPath()!='/'){
    return false;
}else{
    include PAGE_DIR.'/logout.php';
}
echo $execute($params);


