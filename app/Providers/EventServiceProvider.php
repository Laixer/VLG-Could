<?php

namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\ProjectStatusChange' => [
            'App\Listeners\ProjectStatusNotification',
            'App\Listeners\ProjectClose',
        ],
        'App\Events\ProjectUploadReport' => [
            'App\Listeners\ProjectReportTodoComplete',
        ],
        'App\Events\ProjectUpdateReport' => [
            'App\Listeners\ProjectReportConcept',
            'App\Listeners\ProjectReportFinal',
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //
    }
}
