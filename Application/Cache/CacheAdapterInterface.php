<?php


namespace Application\Cache;


interface CacheAdapterInterface
{
    public function hasKey($key);
    public function getFromCache($key,$group=Constants::DEFAULT_GROUP);
    public function saveToCache($key,$data,$group=Constants::DEFAULT_GROUP);
    public function removeBykey($key);
    public function removeBygroup($group);
}
