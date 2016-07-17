<?php
Route::group(['middleware' => ['web']], function () {
    Route::get(LanguageSwitcher::getSwitchPath() . '/{language}', '\\ied3vil\\LanguageSwitcher\\LanguageSwitcherController@setLanguage');
});