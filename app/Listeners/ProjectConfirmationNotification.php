<?php

namespace App\Listeners;

use Mail;
use App\Audit;
use App\Events\ProjectConfirmation;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProjectConfirmationNotification
{
    /**
     * Handle the event.
     *
     * @param  ProjectConfirmation  $event
     * @return void
     */
    public function handle(ProjectConfirmation $event)
    {
        $project = $event->project;

        $email = $project->resolveContactEmail();
        $contact = $project->resolveContact();

        if (!$email || !$contact)
            return;

        Mail::raw('Email P', function ($message) use ($project, $email, $contact) {
            $message->subject('Subject email P');
            $message->from('no-reply@rotterdam-cloud.com', 'Rotterdam Cloud');
            $message->to($email, $contact);
        });

        (new Audit('Email project bevestiging verstuurd', $project->id))->save();
    }
}
