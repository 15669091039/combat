<?php
/**
 * Create by ZhangShuo
 * Date: 2021/7/28
 * Time: 15:36
 * When you read this code, good luck for you.
 */

namespace Application\Filter;


interface CallbackInterface
{
    public function __invoke($item,$params):Result;

}
