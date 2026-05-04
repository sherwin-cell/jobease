<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Login;
use App\Listeners\LogUserRegistration;
use App\Listeners\LogSuccessfulLogin;

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
        // This ensures activities are properly attributed to the user who performed them
        if (class_exists(\Spatie\Activitylog\ActivityLogger::class)) {
            \Spatie\Activitylog\ActivityLogger::setCauserResolver(function () {
                return auth()->user();
            });
        }
    }
}