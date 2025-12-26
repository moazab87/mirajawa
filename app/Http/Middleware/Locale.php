<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class Locale
{

    public function handle($request, Closure $next)
    {
        date_default_timezone_set('Africa/Cairo');
        $allowedLanguages = config('app.locales'); // ['en', 'ja', 'ar']
        $defaultLocale = 'en'; // Use 'en' as default instead of config('app.locale') which is 'ar'
        
        if ($request->hasHeader("lang")) {
            $headerLang = $request->header("lang");
            // Validate header language is in allowed list
            $locale = in_array($headerLang, $allowedLanguages) ? $headerLang : $defaultLocale;
            App::setLocale($locale);
        } else {
            $locale = $request->session()->get('Lang');
            if ($locale !== null && in_array($locale, $allowedLanguages)) {
                App::setLocale($locale);
            } else {
                // If session locale is null or not in allowed list, use default
                $locale = $defaultLocale;
                $request->session()->put('Lang', $locale);
                App::setLocale($locale);
            }
        }

        return $next($request);
    }
}
