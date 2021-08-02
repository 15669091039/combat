<?php
/**
 * Create by ZhangShuo
 * Date: 2021/7/30
 * Time: 18:40
 * When you read this code, good luck for you.
 */

namespace Application\Web\Rest;


use Application\Web\{Request,Response};

interface ApiInterface
{
    public function get(Request $request,Response $response);
//    public function post(Request $request,Response $response);
//    public function put(Request $request,Response $response);
//    public function delete(Request $request,Response $response);
//    public function authenticate(Request $request);
}
