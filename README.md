# LanguageSwitcher
Laravel Language Switcher Package

## Description
This package provides an easy to work with language switcher that you can use in your projects with a wide variety of config options.
It automatically bootstraps to your Laravel project, sets the locale, and switches the languages when needed.

Configuration provided supports a dynamic array of different options to adjust the functionality of the package to suit your needs,
whereas the default provided config will allow you to use the package right after installing, with almost no additional work.

I know it may seem very simple and perhaps over-complicated, but you don't have to waste time and thought process on the simple things.

## Installation
To install the package, just run composer require ied3vil/language-switcher and follow the instructions.
If you want to add it to your composer.json manually, just open composer.json and search for the "autoload" field and add
```
composer require ied3vil/language-switcher
```

After the package is installed, you should run the vendor:publish command in the console so the package publishes its config file to your application.
The package should work fine without this step, all config options have fall backs - however it may impact future use, so it is recommended not to skip the vendor:publish command.
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

## Usage
The default language set in your app.locale config value will be set. You can find it in the `config/app.php` config file.

Switching the current language can be done in quite a few ways.

1. Using the provided facade: `LanguageSwitcher::setLanguage($language)`
2. Using the provided `/lang/{language}` route. The config file provides flexibility in changing the actual "lang" route.
This route can be changed using the [configuration](#configuration).

When using the provided routes for switching languages, you will be redirected to the '/' route after the new language is set.

You should be all set! You can start writing your content in multiple languages!
For more information on how to do this, please consult [Laravel's Documentation](https://laravel.com/docs/5.2/localization).

Alternatively, you can set this yourself using your own routes, just set the session value `'language'` to the new locale and redirect.

## Configuration
The package ships with quite a few configuration options:
```
return [
    'switchPath' => 'lang',
    'store' => 'session',
    'key' => 'language',
    'redirect' => 'route', //can be set to route | back
    'redirect_route' => '/',
];
```
The above config options can be used to customize the switcher's functionality, as described below.
You are free to use any method to configure the package. Remember to use the publish:vendor command to avoid unexpected issues.

To set options, you can use any of the following methods:
1. Changing the config file `config/languageswitcher.php`, editing the values of the provided keys (recommended)
2. Using laravel's runtime configuration helper - `Config::set()` | `config()->set()`, with the specification that you use the 'languageswitcher' preffix for the keys (eg. `languageswitcher.switchPath` for changing the switch path).

##### Changing the switcher's route (default: lang/{language_flag})
* Config key: `languageswitcher.switchPath`
* Default Value: `lang`

This config setting dynamically sets the route created in the package for switching the language.

##### Changing store method - session | cookie (default: session)
* Config key: `languageswitcher.store`
* Default value: `session`
* Accepted values: `session | cookie`

This config setting changes the storage method of the language flag.
Default is session, but cookies with forever as expiry date can be used.
Initially this was set up as a cookie with a configurable expiry date, but for obvious reasons it was set up to never expire.

##### Changing the key where the language flag is stored (default: lang)
* Config key: `languageswitcher.key`
* Default value: `language`

This config setting decides what key to be used when storing the language flag, to the session or cookie.

##### Changing the redirect type (default: route redirect to '/')
* Config keys: `languageswitcher.redirect` and `languageswitcher.redirect_route`
* Default value for `languageswitcher.redirect`: `route`
* Accepted values: `route | back`
* Default value for `languageswitcher.redirect_route`: `/`

When the `languageswitcher.redirect` config value is set to route, the user is redirected to the specified `languageswitcher.redirect_route` after the new language flag is set.
Setting the `languageswitcher.redirect` to `back` will redirect the user back to the previous page after the new language flag is set.

## Examples
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


## Bugs/Issues/Improvements
Feel free to use github for issues and suggesting improvements.
