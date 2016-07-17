<?php


namespace ied3vil\LanguageSwitcher;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use ied3vil\LanguageSwitcher\Facades\LanguageSwitcher as Switcher;

class LanguageSwitcherController extends BaseController
{

    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    public function setLanguage($language)
    {
        //@todo refactor this method to something prettier
        //session
        if (Switcher::getStorageMethod() == 'session') {
            Switcher::setLanguage($language);
            if (Switcher::getRedirect() == 'route') {
                return redirect(Switcher::getRedirectRoute());
            }
            return back();
        }
        //cookie
        if (Switcher::getRedirect() == 'route') {
            return redirect(Switcher::getRedirectRoute())->withCookie(Switcher::setLanguage($language));
        }
        return back()->withCookie(Switcher::setLanguage($language));
    }
}

