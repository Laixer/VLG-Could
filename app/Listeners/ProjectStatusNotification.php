<?php

namespace App\Listeners;

use Mail;
use App\Audit;
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

        $email = $project->resolveContactEmail();
        $contact = $project->resolveContact();

        if (!$email || !$contact)
            return;

        Mail::raw('Email A', function ($message) use ($project, $email, $contact) {
            $message->subject('Subject email A');
            $message->from('no-reply@rotterdam-cloud.com', 'Rotterdam Cloud');
            $message->to($email, $contact);
        });

        (new Audit('Email nieuwe projectstatus verstuurd', $project->id))->save();
    }
}
