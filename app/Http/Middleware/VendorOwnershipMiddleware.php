<?php

namespace App\Http\Middleware;

use App\Base\Response\apiResponse;
use App\Enums\UserTypeEnum;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VendorOwnershipMiddleware
{
    use apiResponse;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $vendor = auth()->user()->vendor;
        if (!$vendor) {
            return $this->failed(__('api.must_be_a_vendor_first'), [], 403);
        }

        if($vendor && !in_array(auth()->user()->type, [UserTypeEnum::VENDOR_WORKSHOP, UserTypeEnum::VENDOR_CAR_SHOWROOM, UserTypeEnum::VENDOR_SPARE_PARTS])) {
            return $this->failed(__('api.vendor_request_not_approved'), [], 403);
        }

        return $next($request);
    }
}
