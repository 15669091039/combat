<?php


namespace Application\Routing;


use Psr\Http\Message\ServerRequestInterface;

/**
 * Class Router 路由类
 *
 * 现进行特殊匹配，再进行普通匹配
 * @package Application\Routing
 */
class Router
{
    const DEFAULT_MATCH = 'default';
    const ERROR_NO_DEF = 'ERROR : must supply a default match';
    protected $requestUri;
    protected $request;
    protected $uriParts;
    protected $docRoot;
    protected $config;
    protected $routeMatch;

    /**
     * 构造函数
     * Router constructor.
     * @param ServerRequestInterface $request
     * @param $docRoot
     * @param $config
     */
    public function __construct(ServerRequestInterface $request, $docRoot, $config)
    {
        $this->config=$config;
        $this->docRoot=$docRoot;
        $this->request=$request;
        $this->requestUri=$request->getServerParams()['REQUEST_URI'];
        if (!isset($config[self::DEFAULT_MATCH])){
            throw new \InvalidArgumentException(self::ERROR_NO_DEF);
        }
    }

    public function getRequest()
    {
        return $this->request;
    }
    public function getDocRoot()
    {
        return $this->docRoot;
    }
    public function getRouteMatch()
    {
        return $this->routeMatch;
    }
    public function isFileOrDir(){
        $fn=$this->docRoot.'/'.$this->requestUri;
        $fn=str_replace('//','/',$fn);
        if (file_exists($fn)){
            return $fn;
        }else{
            return  '';
        }
    }
    public function match()
    {
        foreach ($this->config as $key=>$route){
            if (preg_match($route['uri'],$this->requestUri,$matches)){
                $this->routeMatch['key']=$key;
                $this->routeMatch['match']=$matches;
                return $route['exec'];
            }
        }
    }






}