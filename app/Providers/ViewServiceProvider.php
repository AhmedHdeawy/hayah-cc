<?php

namespace App\Providers;

use App\Models\Slider;
use App\Models\Category;
use App\Models\Country;
use App\Models\Language;
use App\Models\State;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $languages = Language::active()->get();

            $countries = Cache::rememberForever('countries', function () {
                return Country::active()->get();
            });

            $states = Cache::rememberForever('states', function () {
                return State::active()->get();
            });

            $view->with('languages', $languages);
            $view->with('countries', $countries);
            $view->with('states', $states);
        });

        View::composer('front.slider', function ($view) {
            $sliders = Slider::active()->get();
            $view->with('sliders', $sliders);
        });
    }
}
