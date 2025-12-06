<?php

namespace App\Http\Middleware;

use App\Base\Response\apiResponse;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAuthStatusMiddleware
{
    use apiResponse ;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            return $this->unauthenticatedReturn();
        }

        $user = auth()->user();

        if ($user->is_blocked) {
            return $this->blockedReturn($user);
        }

        if (!$user->is_approved) {
            return $this->emailActivationReturn($user);
        }

        return $next($request);
    }
}
