<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider {
    /**
     * Register any application services.
     */
    public function register(): void {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void {
        // Üretim ortamındaysa tüm URL'leri HTTPS olarak zorla
        if (env('APP_ENV') !== 'local') {
            URL::forceScheme('https');
        }
    }
}
