<?php

namespace ied3vil\LanguageSwitcher\Providers;

use ied3vil\LanguageSwitcher\LanguageSwitcher;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Foundation\AliasLoader;

class LanguageSwitcherProvider extends ServiceProvider
{
    public function register()
    {
        //register facade to be used
        AliasLoader::getInstance()->alias('LanguageSwitcher', \ied3vil\LanguageSwitcher\Facades\LanguageSwitcher::class);
        App::bind('LanguageSwitcher', function () {
            return new LanguageSwitcher();
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/languageswitcher.php' => config_path('languageswitcher.php'),
        ]);
        //include routes for switching the language
        if (!App::routesAreCached()) {
            require __DIR__ . '/../routes.php';
        }
    }
}