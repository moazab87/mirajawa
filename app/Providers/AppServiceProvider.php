<?php

namespace App\Providers;

use App\Http\View\Composers\FixedPagesComposer;
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
        
        // Share fixedPages with all web views
        View::composer('web.*', FixedPagesComposer::class);
    }
}
