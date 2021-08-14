<?php
/**
 * Create by ZhangShuo
 * Date: 2021/8/12
 * Time: 18:27
 * When you read this code, good luck for you.
 */

namespace Application\Acl;


use Application\Middleware\Response;
use Application\Middleware\TextStream;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class Authenticate
{
    const ERROR_AUTH = 'ERROR:INVALID TOKEN';
    const DEFAULT_KEY = 'auth';
    protected $adapter;
    protected $key;
    protected $token;

    public function __construct(AuthenticateInterface $adapter, $key)
    {
        $this->key = $key;
        $this->adapter = $adapter;
    }

    public function getToken()
    {
        $this->token = bin2hex(random_bytes(16));
        $_SESSION['token'] = $this->token;
        return $this->token;
    }

    public function matchToken($token)
    {
        $sessToken = $_SESSION['token'] ?? date('Ymd');
        return ($token == $sessToken);
    }

    public function getLoginForm($action = null)
    {
        $action = ($action) ? 'action=" ' . $action . ' " ' : ' ';
        $output = '<form method="post"  ' . $action . '>';
        $output .= '<table>';
        $output .= '<tr><th>Username</th><td><input type="text" name="username"></td></tr>';
        $output .= '<tr><th>Password</th><td><input type="password" name="password"></td></tr>';
        $output .= '<tr><th></th><td><input type="submit" ></td></tr>';
        $output .= '<input type="hidden" name="token" value="' . $this->getToken() . '">';
        $output .= '</form>';
        return $output;
    }

    public function login(RequestInterface $request):ResponseInterface
    {
        $params=json_decode($request->getBody()->getContents());
        $token=$params->token??false;
        if (!($token&&$this->matchToken($token))){
            $code=400;
            $body=new TextStream(self::ERROR_AUTH);
            $response=new Response($code,$body);
        }else{
            $response=$this->adapter->login($request);
        }
        if ($response->getStatusCode()>=200&&$response->getStatusCode()<300){
            $_SESSION[$this->key]=json_decode($response->getBody()->getContents());
        }else{
            $_SESSION[$this->key]=null;
        }
        return  $response;


    }

}
