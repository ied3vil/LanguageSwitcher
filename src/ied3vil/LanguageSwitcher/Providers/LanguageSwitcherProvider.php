<?php


namespace ied3vil\LanguageSwitcher\Providers;

use ied3vil\LanguageSwitcher\LanguageSwitcher;
use Illuminate\Support\ServiceProvider;

class LanguageSwitcherProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot()
    {
        $languageSwitcher = new LanguageSwitcher();
        $languageSwitcher->registerLanguage();
    }
}