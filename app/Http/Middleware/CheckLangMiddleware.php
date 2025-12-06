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

        if($lang == '' || !in_array($lang, ['ar', 'en']) || $lang == null){
            if(auth()->check()){
                $lang = auth()->user()->lang;
            }else{
                $lang = 'ar';
            }
        }
        app()->setLocale($lang);
        return $next($request);
    }
}
