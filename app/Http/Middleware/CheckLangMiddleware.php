<?php

namespace App\Http\Middleware;

use App\Base\Response\apiResponse;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLangMiddleware
{
    use apiResponse;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $lang = $request->header('lang');
        $allowedLanguages = ['en', 'ja', 'ar'];

        if($lang == '' || !in_array($lang, $allowedLanguages) || $lang == null){
            if(auth()->check()){
                $userLang = auth()->user()->lang;
                // Validate user's language is in allowed list, otherwise default to 'en'
                $lang = in_array($userLang, $allowedLanguages) ? $userLang : 'en';
            }else{
                $lang = 'en'; // Default to 'en' instead of 'ar'
            }
        }
        
        // Final validation to ensure lang is always in allowed list
        if(!in_array($lang, $allowedLanguages)){
            $lang = 'en';
        }
        
        app()->setLocale($lang);
        return $next($request);
    }
}

