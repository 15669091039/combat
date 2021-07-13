<?php
/**
 * Create by ZhangShuo
 * Date: 2021/7/13
 * Time: 15:42
 * When you read this code, good luck for you.
 */

namespace Application\Web;


class Securityclass
{
    public function __construct(){
        $this->filter=[
            'striptags'=>function($a){return strip_tags($a);},
            'digits'=>function($a){return preg_replace('/[^0-9]/','',$a);},
            'alpha'=>function($a){return preg_replace('/[^A-Z]/i','',$a);}
        ];
        $this->validate = [
            'alnum'=>function($a){return ctype_alnum($a);},
            'digits'=>function($s){return ctype_digit($s);},
            'alpha'=>function($a){return ctype_alpha($a);}
        ];
    }

}
