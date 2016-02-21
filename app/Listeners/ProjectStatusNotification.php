<?php

namespace App\Listeners;

use Mail;
use App\Events\ProjectStatusChange;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProjectStatusNotification
{
    /**
     * Handle the event.
     *
     * @param  ProjectStatusChange  $event
     * @return void
     */
    public function handle(ProjectStatusChange $event)
    {
        $project = $event->project;
        return;

        Mail::raw($project->name . ' , gewoon kaas', function ($message) use ($project) {
            $message->subject('Project is geupdatet');
            $message->from('no-reply@rotterdam-cloud.com', 'Rotterdam Cloud');
            $message->to('yorick17@outlook.com', 'Yorick de Wid');
        });
    }
}
