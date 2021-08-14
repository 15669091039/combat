<?php
/**
 * Create by ZhangShuo
 * Date: 2021/8/14
 * Time: 10:02
 * When you read this code, good luck for you.
 */

namespace Application\Acl;


use Application\Middleware\Response;
use Application\Middleware\TextStream;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class Acl
{
    const DEFAULT_STATUS='';
    const DEFAULT_LEVEL=0;
    const DEFAULT_PAGE=0;
    const ERROR_ACL='ERROR:AUTHORIZATION ERROR';
    const ERROR_APP='ERROR:requested page not listed';
    const ERROR_DEF='error: must assign keys levels ,pages and allowed';
    protected  $default;
    protected $levels;
    protected $pages;
    protected $allowed;
    public function __construct(array $assignment)
    {
        $this->default=$assignment['default']??self::DEFAULT_PAGE;
        $this->pages=$assignment['pages']??false;
        $this->levels=$assignment['allowed']??false;
        $this->allowed=$assignment['allowed']??false;
        if (!($this->pages&&$this->levels&&$this->allowed)){
            throw  new \InvalidArgumentException(self::ERROR_DEF);
        }
    }
    public function mergeInherited($status,$level)
    {
        $allow=$this->allowed[$status]['pages'][$level]??array();
        for ($x=$status;$x>0;$x--){
            $inherited=$this->allowed[$x]['inherits'];
            if ($inherited){
                $subArray=$this->allowed[$inherited]['pages'][$level]??[];
                $allow=array_merge($allow,$subArray);
            }
        };
        return $allow;
    }
    public function isAuthorized(RequestInterface $request)
    {
        $code=401;
        $text['page']=$this->pages[$this->default];
        $text['authorized']=false;
        $page=$request->getUri()->getQueryParams()['page']??false;
        if ($page==false){
            $code=400;
        }else{
            $params=json_decode($request->getBody()->getContents());
            $status=$params->status??self::DEFAULT_LEVEL;
            $level=$params->level??'*';
            $allowed=$this->mergeInherited($status,$level);
            if (in_array($page,$allowed)){
                $code=200;
                $text['authorized']=true;
                $text['page']=$this->pages[$page];
            }else{
                $code=401;
            }
        }
        $body=new TextStream(json_encode($text));
        return (new Response())->withStatus($code)->withBody($body);
    }



}
