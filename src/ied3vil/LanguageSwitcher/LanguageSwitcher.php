<?php
namespace ied3vil\LanguageSwitcher;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class LanguageSwitcher
{

    public function __construct()
    {
    }
    public function registerLanguage()
    {
        App::setLocale($this->getCurrentLanguage());
    }

    public function getCurrentLanguage()
    {
        return Session::get('language', Config::get('app.locale'));
    }

    public function setLanguage($language)
    {
        echo 'Setting Language: ' . $language;
        Session::set('language', $language);
        $this->registerLanguage();
    }
}
