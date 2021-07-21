<?php
/**
 * Create by ZhangShuo
 * Date: 2021/7/21
 * Time: 15:13
 * When you read this code, good luck for you.
 */

namespace Application\chap04;

/**
 * Class Customer
 *
 * 本类主要是演示继承作用
 * @package Application\chap04
 */
class Customer extends Base
{
    public const LOCAL='this is local';
    public function getLocal(){
        return self::LOCAL;
    }



}
