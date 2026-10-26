<?php

namespace App\Providers;

use App\Models\ActivityLog;
use Illuminate\Auth\Events\Failed;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Event;
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
        // Write authentication activity to the logs table.
        Event::listen(Registered::class, function (Registered $event) {
            ActivityLog::record('Registered a new account', $event->user->id);
        });

        Event::listen(Login::class, function (Login $event) {
            ActivityLog::record('Logged in', $event->user->id);
        });

        Event::listen(Logout::class, function (Logout $event) {
            if ($event->user) {
                ActivityLog::record('Logged out', $event->user->id);
            }
        });

        Event::listen(Failed::class, function (Failed $event) {
            if ($event->user) {
                ActivityLog::record('Failed login attempt', $event->user->id);
            }
        });
    }
}
