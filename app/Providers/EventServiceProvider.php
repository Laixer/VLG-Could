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
        'App\Events\ProjectStatusChange' => [
            'App\Listeners\ProjectStatusNotification',
            'App\Listeners\ProjectClose',
        ],
        'App\Events\ProjectUpdateReport' => [
            'App\Listeners\ProjectReportTodoComplete',
            'App\Listeners\ProjectReportConcept',
            'App\Listeners\ProjectReportFinal',
        ],
        // 'App\Events\ProjectReminder' => [
            // 'App\Listeners\ProjectReminderNotification',
        // ],
        'App\Events\ProjectConfirmation' => [
            'App\Listeners\ProjectConfirmationNotification',
        ],
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
