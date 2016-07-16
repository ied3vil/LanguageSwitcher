<?php


namespace ied3vil\LanguageSwitcher\ServiceProviders;


class LanguageSwitcherProvider extends ServiceProvider
{
    public function register()
    {
        echo 'Language Provider Registered';
    }

    public function boot()
    {
        echo 'Language Provider Booted';
    }
}