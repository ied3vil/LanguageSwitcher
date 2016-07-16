<?php


namespace ied3vil\LanguageSwitcher\Middleware;
use Closure;
use ied3vil\LanguageSwitcher\Facades\LanguageSwitcher;

class LanguageSwitcherMiddleware
{
    public function handle($request, Closure $next)
    {
        LanguageSwitcher::registerLanguage();
        return $next($request);
    }
}