<?php

namespace App\Providers;

use App\Events\ModelRated;
use App\Events\ModelUnrated;
use App\Jobs\UpdateLastLogin;
use App\Listeners\SendEmailModelRatedNotification;
use App\Listeners\SendEmailModelUnratedNotification;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        ModelRated::class => [
            SendEmailModelRatedNotification::class,
        ],
        ModelUnrated::class => [
            SendEmailModelUnratedNotification::class,
        ],
        Login::class => [
            UpdateLastLogin::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
