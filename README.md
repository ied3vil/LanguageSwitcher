# LanguageSwitcher
Laravel Language Switcher Package

##Description
This package provides an easy to work with language switcher that you can use in your projects.
It automatically bootstraps to your Laravel project, sets the locale, and switches the languages when needed.

Configuration provided supports a dynamic route for switching languages that defaults to 'lang', and redirects to the '/' route.
Additional configuration will be added so you can customize the redirect and the method we store the current language.

##Installation
To install the package, just run composer require ied3vil/language-switcher and follow the instructions.
If you want to add it to your composer.json manually, just open composer.json and search for the "autoload" field and add
```
composer require ied3vil/language-switcher
```

After the package is installed, you should run the vendor:publish command in the console so the package publishes its config file to your application.
You can ignore this step if you don't plan to use a custom route for switching languages, or if you are using the default "lang" route.
```
php artisan vendor:publish
```
To start using the package,you have to include its service provider and middleware in your application.
To include the service provider, just go to your `config/app.php` file, find the providers array and append the language switcher provider at the bottom.
```
    'providers' => [
        .
        .
        .
        ied3vil\LanguageSwitcher\Providers\LanguageSwitcherProvider::class,
    ],
```
Next, go to `app/Http/Kernel.php` and find the middleware array. You have two options:
1. Register the middleware as a route and use it within your routes, if you only want to use it only for the
routes you need it for
2. **Recommended:** Include the middleware within the 'web' middleware group, making it globally available.
Not including the middleware will fail to register the locale and the current selected language will not register.
Make sure you include the middleware at the end of the array, because it is reliant on Session to work.
```
        'web' => [
            .
            .
            .
            \ied3vil\LanguageSwitcher\Middleware\LanguageSwitcherMiddleware::class,
        ],
```


You are now ready to use the language switcher!

##Usage

The default language set in your app.locale config value will be set. You can find it in the `config/app.php` config file.

Switching the current language can be done in quite a few ways.

1. Using the provided facade: `LanguageSwitcher::setLanguage($language)`
2. Using the provided `/lang/{language}` route. The config file provides flexibility in changing the actual "lang" route.
This route can be changed using the [configuration](#configuration).

When using the provided routes for switching languages, you will be redirected to the '/' route after the new language is set.

You should be all set! You can start writing your content in multiple languages!
For more information on how to do this, please consult [Laravel's Documentation](https://laravel.com/docs/5.2/localization).

##Configuration
For now, only the route used for language switching can be configured.
####Changing the switcher's route
The language switching route can be set in the `config/languageswitcher.php` configuration file
(you must run `php artisan vendor:publish` for it to be copied to your config folder), or programatically using
laravel's `Config::set()` / `config()->set()` methods. The key for the route is `'languageswitcher.switchPath'`.
The recommended procedure is changing the config file `config/languageswitcher.php`.

##Examples
My preffered way to usage is this: I include the library, create my UI for switching the language, and start translating!

Example HTML:
```
<ul class="dropdown-menu">
    <li><a href="{{ url('lang/en') }}"><img src="/img/flags/en.png" alt="">{{ trans('locale.en') }}</a></li>
    <li><a href="{{ url('lang/dk') }}"><img src="/img/flags/dk.png" alt="">{{ trans('locale.dk') }}</a></li>
    <li><a href="{{ url('lang/sw') }}"><img src="/img/flags/sw.png" alt="">{{ trans('locale.sw') }}</a></li>
</ul>
```
If you want to evidentiate the current selection language, you can use App::getLocale() or LanguageSwitcher::getCurrentLanguage().
##More Information
You can find more information on regarding this package on my website, [www.ied3vil.com](http://www.ied3vil.com).