<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class Locale
{

    public function handle($request, Closure $next)
    {
        date_default_timezone_set('Africa/Cairo');
        if ($request->hasHeader("lang")) {
            App::setLocale($request->header("lang"));
        } else {
            $locale = $request->session()->get('Lang');
            if ($locale !== null && in_array($locale, config('app.locales'))) {
                App::setLocale($locale);
            }
            if ($locale === null) {
                $request->session()->put('Lang', config('app.locale'));
                App::setLocale(config('app.locale'));
            }
        }

        return $next($request);
    }
}
