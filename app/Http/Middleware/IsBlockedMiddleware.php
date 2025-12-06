<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class IsBlockedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard()->check() && auth()->user()->is_blocked) {
            auth()->user()->logout();
            return response()->json([
                'status'        => "blocked",
                'message'       => __('api.blocked')
            ], 403);
        }
        return $next($request);
    }

}
