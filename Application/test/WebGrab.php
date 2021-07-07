<?php
/**
 * Create by ZhangShuo
 * Date: 2021/7/5
 * Time: 15:27
 * When you read this code, good luck for you.
 */

namespace Application\test;


class WebGrab
{
    protected $content=false;
    // 获得内容， 利用DomDocument类
    public function getContent($url){
        if (!$this->content) {
            $url = 'http://' . $url;

            $this->content = new \DOMDocument('1.0', 'utf-8');
            $this->content->preserveWhiteSpace = false;
            // @符号用于过滤掉配置错误的网页所生成的警告
            @$this->content->loadHTMLFile($url);
        }
        return $this->content;
    }
   // 获取指定的标签 以及标签的内容
    public function getTags($url,$tag){
        $count=0;
        $result=array();
        $elements=$this->getContent($url)->getElementsByTagName($tag);
        foreach ($elements as $node){
            $result[$count]['value']=trim(preg_replace('/\s+/',' ',$node->nodeValue));
            if ($node->hasAttributes()){
                foreach ($node->attributes as $name=>$attr){
                    $result[$count]['attributes'][$name]=$attr->value;
                }
            }
            $count++;
        }
        return $result;
    }
   // 获取指定的属性
    public function getAttribute($url,$attr,$domain=null){
        $result=array();
        $element=$this->getContent($url)->getElementsByTagName('*');
        foreach ($element as $node){
            if ($node->hasAttribute($attr)){
                $value=$node->getAttribute($attr);
                if ($domain){
                    if (stripos($value,$domain)!==false){
                        $result[]=trim($value);
                    }
                }else{
                    $result[]=trim($value);
                }
            }
        }
        return $result;

    }





}
