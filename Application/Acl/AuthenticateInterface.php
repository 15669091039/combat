<?php
/**
 * Create by ZhangShuo
 * Date: 2021/8/4
 * Time: 10:56
 * When you read this code, good luck for you.
 */

namespace Application\Acl;
use Psr\Http\Message\{RequestInterface,ResponseInterface};
interface AuthenticateInterface
{
 public function login(RequestInterface $request):ResponseInterface;

}
