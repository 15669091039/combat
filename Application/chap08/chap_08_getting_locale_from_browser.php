<?php
/**
 * Create by ZhangShuo
 * Date: 2021/8/4
 * Time: 9:51
 * When you read this code, good luck for you.
 */
include '../Autoload/Loader.php';
\Application\Autoload\Loader::init(__DIR__ . '/../..');

use Application\I18n\Locale;
$locale=[null,'fr-FR','da, en-gb;q=0.8,en;q=0.7'];
//获取当前完整url,为了清晰，多定义几个变量,分几行写
$scheme = $_SERVER['REQUEST_SCHEME']; //协议
$domain = $_SERVER['HTTP_HOST']; //域名/主机
$requestUri = urldecode($_SERVER['REQUEST_URI']); //请求参数
//将得到的各项拼接起来
$currentUrl = $scheme . "://" . $domain . $requestUri;
$url=parse_url($currentUrl);
$s='sadsadsa';
$m=$s[0];
echo '<table>';
foreach ($locale as $code) {
    $locale = new Locale($code);
    echo '<tr><td>' . htmlspecialchars($code) . '</td><td>' . $locale->getLocalCode() . '</td></tr>';
}
echo '</table>';
