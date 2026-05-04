<?php

// In App\Providers\EventServiceProvider — add only this listener.
// DELETE LogUserRegistration entirely (RegisterController already handles it).

namespace App\Providers;

use Illuminate\Auth\Events\Login;
use App\Listeners\LogSuccessfulLogin;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        // ... your other event/listener pairs ...

        Login::class => [
            LogSuccessfulLogin::class,  // ✅ Keep
        ],

        // ❌ DELETE this block entirely — RegisterController already logs registration
        // Registered::class => [
        //     LogUserRegistration::class,
        // ],
    ];
}