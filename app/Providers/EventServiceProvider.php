<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        //
    ];

    /**
     * Subscriber, ktory pocuva na eventy PostCreated, PostDeleted a PostViewed.
     * Obsahuje metody, ktore obsluhuju tieto eventy.
     *
     */
    protected $subscribe = [
        'App\Listeners\PostEventSubscriber',
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
