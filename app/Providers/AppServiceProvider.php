<?php

namespace App\Providers;

use App\Http\View\Composers\SocialsComposer;
use App\Http\View\Composers\WebsiteComposer;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
        // Shipment::observe(ShipmentObserver::class);
        
        View::composer(['web.*', 'web.layouts.app'], WebsiteComposer::class);
        View::composer(['web.*', 'web.layouts.app'], SocialsComposer::class);
    }
}
