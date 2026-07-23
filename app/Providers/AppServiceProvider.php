<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
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
        Paginator::useBootstrapFive();

        /*
         * HTTPS erzwingen, sobald die Anwendung nicht lokal läuft oder
         * APP_URL bereits auf https zeigt. Damit werden alle generierten
         * Links, Assets, Canonical-URLs und die Sitemap automatisch
         * mit https ausgegeben (Voraussetzung für Google Merchant Center).
         */
        if ($this->app->environment('production') || str_starts_with((string) config('app.url'), 'https://')) {
            URL::forceScheme('https');
        }
    }
}
