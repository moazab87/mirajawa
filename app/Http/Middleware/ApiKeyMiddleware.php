<?php

namespace App\Http\Middleware;

use App\Base\Response\apiResponse;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiKeyMiddleware
{
    use apiResponse ;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $apiKey = $request->header('api-key');

        if($apiKey != config('app.apiKey')){
            return $this->unauthenticatedReturn();
        }
        return $next($request);
    }
}
