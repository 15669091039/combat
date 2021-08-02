<?php
/**
 * Create by ZhangShuo
 * Date: 2021/7/30
 * Time: 18:45
 * When you read this code, good luck for you.
 */

namespace Application\Web\Rest;


use Application\Web\Request;
use Application\Web\Response;

abstract class AbstractApi  implements ApiInterface
{
    const TOKEN_BYTE_SIZE=16;
    protected $registeredKeys;
    abstract public function get(Request $request,Response $response);
//    abstract public function post(Request $request,Response $response);
//    abstract public function put(Request $request,Response $response);
//    abstract public function delete(Request $request,Response $response);
//    abstract public function authenticate(Request $request);
    public function __construct($registeredKeys,$tokenField)
    {
        $this->registeredKeys=$registeredKeys;
    }
    public static function generateToken(): string
    {
        try {
            return bin2hex(random_bytes(self::TOKEN_BYTE_SIZE));
        } catch (\Exception $e) {
            return  $e->getMessage();
        }
    }




}
