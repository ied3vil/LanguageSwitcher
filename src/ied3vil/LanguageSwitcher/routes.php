<?php
Route::group(['middleware' => ['web']], function () {
    Route::get(Config::get('languageswitcher.switchPath', 'lang') . '/{language}', '\\ied3vil\\LanguageSwitcher\\LanguageSwitcherController@setLanguage');
});