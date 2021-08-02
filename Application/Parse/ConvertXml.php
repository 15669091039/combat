<?php
/**
 * Create by ZhangShuo
 * Date: 2021/7/30
 * Time: 10:36
 * When you read this code, good luck for you.
 */

namespace Application\Parse;

use  SimpleXMLElement;
use  SimpleXMLIterator;
class ConvertXml
{
    public function xmlToArray(SimpleXMLIterator $xml):array
    {
        $a=array();
        for ($xml->rewind();$xml->valid();$xml->next()){
            if (!array_key_exists($xml->key(),$a)){
                $a[$xml->key()]=[];
            };
            if ($xml->hasChildren()){
                $a[$xml->key()][]=$this->xmlToArray($xml->current());
            }else{
                $a[$xml->key()]=(array)$xml->current()->attributes();
                $a[$xml->key()]['value']=strval($xml->current());
            }
        }
        return  $a;
    }

    public function arrayToXml(array $a)
    {
        $xml=new SimpleXMLElement('<?xml version="1.0" standalone="yes" ?> <root></root>');
        $this->phpToXml($a,$xml);
        return $xml->asXML();
    }
    public function phpToXml($value,&$xml){
        $node=$value;
        if (is_object($node)){
            $node=get_object_vars($node);
        }
        if (is_array($node)){
            foreach ($node as $k=>$v){
                if (is_numeric($k)){
                    $k='number'.$k;

                }
                if (is_array($v)||is_object($v)){
                    $newNode=$xml->addChild($k);
                    $this->phpToXml($v,$newNode);
                }else{
                    $xml->addChild($k,$v);
                }

            }
        }else{
            $xml->addChild('不知道的节点类型',$node);
        }
    }

}
