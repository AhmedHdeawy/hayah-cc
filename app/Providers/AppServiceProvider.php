<?php

namespace App\Providers;

use App\User;
use Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Get Langs
        // $languages = Language::active()->get();
        // $languages = LaravelLocalization::getSupportedLocales();

        // Get Segemnt (3) for used it in Admin Panel
        $segment = Request::segment(3);

        view()->share(compact('segment'));
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
