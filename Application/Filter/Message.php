<?php
/**
 * Create by ZhangShuo
 * Date: 2021/7/28
 * Time: 15:37
 * When you read this code, good luck for you.
 */

namespace Application\Filter;


class Message
{
    const MESSAGE_UNKNOWN='Unknown';
    public static $messages;
    public static function setMessages(array $message)
    {
        self::$messages=$message;
    }
    public static function setMessage($key,$message){
        self::$messages[$key]=$message;
    }
    public static function getMessage($key){
        return self::$messages[$key]??self::MESSAGE_UNKNOWN;
    }


}
