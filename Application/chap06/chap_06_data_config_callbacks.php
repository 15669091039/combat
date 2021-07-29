<?php
/**
 * Create by ZhangShuo
 * Date: 2021/7/28
 * Time: 17:27
 * When you read this code, good luck for you.
 */

use Application\Filter\{Result,Message,CallbackInterface};
$config=[
    'filters'=>[
        'trim'=>new class()implements CallbackInterface
        {
            public function __invoke($item, $params): Result
            {
                $changed=array();
                $filtered=trim($item);
                if ($filtered !==$item)
                    $changed=Message::$messages['trim'];
                return new Result($filtered,$changed);
            }
        },
        'strip_tags'=>new class implements CallbackInterface
        {
            public function __invoke($item, $params): Result
            {
                $changed=array();
                $filtered=strip_tags($item);
                if ($filtered !==$item)
                    $changed=Message::$messages['strip_tags'];
                return new Result($filtered,$changed);
            }
        }
    ],
];
