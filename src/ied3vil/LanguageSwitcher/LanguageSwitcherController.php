<?php


namespace ied3vil\LanguageSwitcher;

use App\Http\Controllers\Controller;

class LanguageSwitcherController extends Controller
{

    public function setLanguage($language)
    {
        $ls = new LanguageSwitcher();
        $ls->setLanguage($language);
        return redirect('/');
    }
}