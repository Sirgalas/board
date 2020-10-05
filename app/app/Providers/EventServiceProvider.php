<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        'App\Events\Event' => [
            'App\Listeners\EventListener',
        ],
        'App\Events\Adverts\Create'=>[
            'App\Listener\Adverts\CreateListener'
        ],
        'App\Events\Adverts\Remove'=>[
            'App\Listener\Adverts\RemoveListener'
        ]
    ];

    public function boot()
    {
        parent::boot();
    }
}
