<?php

namespace App\Providers;

use App\Events\AutorizacaoCreated;
use App\Events\AutorizacaoUpdated;
use App\Listeners\SendNotificationOnAutorizacaoCreated;
use App\Listeners\SendNotificationOnAutorizacaoUpdated;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        AutorizacaoCreated::class => [
            SendNotificationOnAutorizacaoCreated::class,
        ],
        AutorizacaoUpdated::class => [
            SendNotificationOnAutorizacaoUpdated::class,
        ],
    ];

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
