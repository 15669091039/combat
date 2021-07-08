<?php
/**
 * Create by ZhangShuo
 * Date: 2021/7/8
 * Time: 8:59
 * When you read this code, good luck for you.
 */

namespace Application\test;


class Deep
{
    protected $domain;

    public function scan($url, $tag)
    {
       $vac =new WebGrab();
       $scan=$vac->getAttribute($url,'href',$this->getDomain($url));
       $result=array();
       foreach ($scan as $subSite){
           yield from $vac->getTags($subSite,$tag);
       }
       return count($scan);
    }
    public function getDomain($url){
        if (!$this->domain){
            $this->domain=parse_url($url,PHP_URL_HOST);
        }
        return $this->domain;
    }

}
