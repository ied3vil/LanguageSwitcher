<?php
namespace ied3vil\LanguageSwitcher;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Request;

class LanguageSwitcher
{
    /**
     * Registers the language to the app Locale
     */
    public function registerLanguage()
    {
        App::setLocale($this->getCurrentLanguage());
    }

    /**
     * Returns the current language set in the session/cookie
     * @return string
     */
    public function getCurrentLanguage()
    {
        if ($this->getStorageMethod() == 'session') {
            return Session::get($this->getLanguageKey(), Config::get('app.locale'));
        }
        return Request::cookie($this->getLanguageKey());
    }

    /**
     * Sets the language flag and returns the cookie to be created on the redirect
     * @param $language
     * @return mixed | null
     */
    public function setLanguage($language)
    {
        if ($this->getStorageMethod() == 'cookie') {
            return cookie()->forever($this->getLanguageKey(), $language);
        }
        Session::set($this->getLanguageKey(), $language);
        $this->registerLanguage();
        return cookie('dummy-cookie', FALSE, 1); //just for cleaner code in the controller
    }

    /**
     * Gets the storage method for the language flag
     * @return string session | cookie
     */
    public function getStorageMethod()
    {
        return Config::get('languageswitcher.store', 'session'); //defaults to session
    }

    /**
     * Gets the language key that is used to store the language
     * @return mixed
     */
    public function getLanguageKey()
    {
        return Config::get('languageswitcher.key', 'language');
    }

    /**
     * Gets the switch route for switching the language
     * @return string
     */
    public function getSwitchPath()
    {
        return Config::get('languageswitcher.switchPath', 'lang');
    }

    /**
     * Gets the redirect type, that can be route or back
     * @return string
     */
    public function getRedirect()
    {
        return Config::get('languageswitcher.redirect', 'route');
    }

    /**
     * Gets the redirect route set in the config
     * @return string
     */
    public function getRedirectRoute()
    {
        return Config::get('languageswitcher.redirect_route', '/');
    }
}
