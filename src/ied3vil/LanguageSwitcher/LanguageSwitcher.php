<?php
namespace ied3vil\LanguageSwitcher;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Request;

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
        return Request::cookie($this->getLanguageKey());
    }

    public function setLanguage($language)
    {
        if ($this->getStorageMethod() == 'cookie') {
            return cookie()->forever($this->getLanguageKey(), $language);
        }
        Session::set($this->getLanguageKey(), $language);
        $this->registerLanguage();
    }

    public function getStorageMethod()
    {
        return Config::get('languageswitcher.store', 'session'); //defaults to session
    }

    public function getLanguageKey()
    {
        return Config::get('languageswitcher.key', 'language');
    }

    public function getSwitchPath()
    {
        return Config::get('languageswitcher.switchPath', 'lang');
    }

    public function getRedirect()
    {
        return Config::get('languageswitcher.redirect', 'redirect');
    }
    public function getRedirectRoute()
    {
        return Config::get('languageswitcher.redirect_route', '/');
    }
}
