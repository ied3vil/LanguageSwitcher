# LanguageSwitcher
Laravel Language Switcher Package

##Description
This package provides an easy to work with language switcher that you can use in your projects. It automatically bootstraps to your Laravel project, sets the locale, and switches the languages when needed.
Configuration provided supports a dynamic route for switching languages that defaults to 'lang', and redirects to the '/' route. Additional configuration will be added so you can customize the redirect.

##Installation
To install the package, just run composer require ied3vil/language-switcher and follow the instructions.

If you want to add it to your composer.json manually, just open composer.json and search for the "autoload" field and add
```
composer require ied3vil/language-switcher
```

After the package is installed, you should run the vendor:publish command in the console so the package publishes its config file to your application. You can ignore this step if you don't plan to use a custom route for switching languages, or if you are using the default "lang" route.
```
php artisan vendor:publish
```

You are now ready to use the switcher!

##Usage

##Configuration

##More Information
You can find more information on regarding this package on my website, http://www.ied3vil.com