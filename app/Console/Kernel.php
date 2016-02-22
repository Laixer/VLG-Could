<?php

namespace App\Console;

use App\Project;
use App\Events\ProjectReminder;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function() {
            $projects = Project::where('status_id', '!=', 5)->get();
            event(new ProjectReminder($projects));
        // })->dailyAt('08:00');
        // })->everyMinute();
        })->everyTenMinutes();
    }
}
