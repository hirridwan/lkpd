<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
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
        // Paksa HTTPS agar tidak "Mixed Content" saat pakai Cloudflare Tunnel
        if (config('app.env') === 'production' || env('FORCE_HTTPS', true)) {
            URL::forceScheme('https');
        }
    }
}