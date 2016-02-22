<?php

namespace App\Listeners;

use Mail;
use App\Audit;
use App\Events\ProjectStatusChange;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProjectClose
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

        $email = $project->resolveContactEmail();
        $contact = $project->resolveContact();

        if (!$email || !$contact)
            return;

        if ($project->status->priority == 5) {
            Mail::raw('Email M', function ($message) use ($project) {
                $message->subject('Subject email M');
                $message->from('no-reply@rotterdam-cloud.com', 'Rotterdam Cloud');
                $message->to($email, $contact);
            });

            (new Audit('Email project gesloten verstuurd', $project->id))->save();
        }
    }
}
