<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Language;

class ApiLocalization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $locale = $request->header('lang');
        // Get Langs from DB
        $languages = Language::active()->get();

        if ($locale && $languages->where('locale', $locale)->first()) {
            app()->setlocale($locale);
        } else {
            app()->setlocale($languages->first()->locale);
        }

        return $next($request);
    }
}
