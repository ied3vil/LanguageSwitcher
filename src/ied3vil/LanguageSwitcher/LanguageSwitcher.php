<?php
namespace ied3vil\LanguageSwitcher;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Response;

class LanguageSwitcher
{

    public function registerLanguage()
    {
        App::setLocale($this->getCurrentLanguage());
    }

    public function getCurrentLanguage()
    {
        if ($this->getStorageMethod() == 'session') {
            return Session::get($this->getLanguageKey(), Config::get('app.locale'));
        }
        return Cookie::get($this->getLanguageKey());
    }

    public function setLanguage($language)
    {
        if ($this->getStorageMethod() == 'session') {
            Session::set($this->getLanguageKey(), $language);
        }
        if ($this->getStorageMethod() == 'cookie') {
            Cookie::make('City', 'New York', $this->getCookieExpiration());
        }
        $this->registerLanguage();
    }

    private function getStorageMethod()
    {
        return Config::get('languageswitcher.store', 'session'); //defaults to session
    }

    private function getLanguageKey()
    {
        return Config::get('languageswitcher.key', 'language');
    }

    private function getCookieExpiration()
    {
        return Config::get('languageswitcher.cookie_expiration', 86400);
    }

    public function getSwitchPath()
    {
        return Config::get('languageswitcher.switchPath', 'lang');
    }
}
