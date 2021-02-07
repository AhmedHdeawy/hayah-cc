<?php

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

if (app()->environment('production')) {
    URL::forceScheme('https');
}

/*
|--------------------------------------------------------------------------
| Auth
|--------------------------------------------------------------------------
|
| USER 		=>	auth()->user()
|
| ADMIN		=>	auth()->guard('admin')->user()
\
\ php artisan VueTranslation:generate --watch=1
\
\
*/

// Front Controller
Route::group([
    'namespace' => 'Front',
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {
    // Home
    Route::get('/', 'HomeController@index')->name('home');

});
