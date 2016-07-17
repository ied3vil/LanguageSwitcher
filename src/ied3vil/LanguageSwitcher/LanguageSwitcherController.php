<?php


namespace ied3vil\LanguageSwitcher;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

class LanguageSwitcherController extends BaseController
{

    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    public function setLanguage($language)
    {
        $ls = new LanguageSwitcher();
        $ls->setLanguage($language);
        return redirect('/');
    }
}

