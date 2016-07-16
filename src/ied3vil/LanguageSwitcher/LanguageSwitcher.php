<?php
namespace ied3vil\LanguageSwitcher;

class LanguageSwitcher
{
    public function registerLanguage()
    {
        App::setLocale($this->getCurrentLanguage());
    }

    public function getCurrentLanguage()
    {
        return Session::get('language', Config::get('app.locale'));
    }
}
