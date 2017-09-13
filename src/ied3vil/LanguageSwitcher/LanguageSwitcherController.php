<?php


namespace ied3vil\LanguageSwitcher;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use ied3vil\LanguageSwitcher\Facades\LanguageSwitcher as Switcher;

class LanguageSwitcherController extends BaseController
{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Set the language and redirect
     * @param $language
     * @return mixed
     */
    public function setLanguage($language)
    {
        if (Switcher::getRedirect() == 'route') {
            return redirect(Switcher::getRedirectRoute())->withCookie(Switcher::setLanguage($language));
        }else if(Switcher::getRedirect() == 'locale'){
            return redirect(Switcher::getLocalBack($language))->withCookie(Switcher::setLanguage($language));
        }
        return back()->withCookie(Switcher::setLanguage($language));
    }
}

