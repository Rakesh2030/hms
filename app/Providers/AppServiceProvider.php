<?php

namespace App\Providers;

use App\Models\Setting;
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
        // Register Captcha Service Provider
        $this->app->register(\Mews\Captcha\CaptchaServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share settings with all Blade files so logo, title and footer are dynamic.
        View::composer('*', function ($view) {
            $appSettings = null;

            if (Schema::hasTable('settings')) {
                $appSettings = Setting::first();
            }

            $view->with('appSettings', $appSettings);
        });
    }
}
