<?php

namespace App\Http\View\Composers;

use App\Models\Type;
use App\Models\Period;
use App\Models\Amenitie;
use App\Models\Category;
use Illuminate\View\View;
use App\Models\Completing;
use App\Models\Furnishing;
use Illuminate\Support\Facades\Cache;

class SearchComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $categories = Cache::rememberForever('properties_categories', function () {
            return Category::all();
        });

        $types = Cache::rememberForever('properties_types', function () {
            return Type::all();
        });

        $amenities = Cache::rememberForever('properties_amenities', function () {
            return Amenitie::all();
        });

        $completings = Cache::rememberForever('properties_completings', function () {
            return Completing::all();
        });

        $periods = Cache::rememberForever('properties_periods', function () {
            return Period::all();
        });

        $furnishings = Cache::rememberForever('properties_furnishings', function () {
            return Furnishing::all();
        });

        $view->with('categories', $categories);
        $view->with('types', $types);
        $view->with('amenities', $amenities);
        $view->with('completings', $completings);
        $view->with('periods', $periods);
        $view->with('furnishings', $furnishings);
    }
}
