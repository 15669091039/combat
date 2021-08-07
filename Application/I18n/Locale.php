<?php
/**
 * Create by ZhangShuo
 * Date: 2021/8/4
 * Time: 9:33
 * When you read this code, good luck for you.
 */

namespace Application\I18n;

use Locale as PhpLocale;

class Locale  extends PhpLocale
{
    const FALLBACK_LOCALE = 'en';
    protected $localeCode;

    public function setLocalCode($acceptLangHeader)
    {
        $this->localeCode = $this->acceptFromHttp($acceptLangHeader);
    }

    public function getAcceptLanguage()
    {
        return $_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? self::FALLBACK_LOCALE;
    }

    public function getLocalCode()
    {
        return $this->localeCode;
    }

    public function __construct($localeString)
    {
        if ($localeString){
            $this->setLocalCode($localeString);
        }else{
            $this->setLocalCode(($this->getAcceptLanguage()));
        }
    }

}
