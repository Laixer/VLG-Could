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

        if ($project->status->priority == 2) {
            $data = array(
                'project' => $project,
                'email' => $email,
                'contact' => $contact,
            );

            Mail::send('mail.status_notification', $data, function ($message) use ($email, $contact) {
                $message->subject('Subject email A');
                $message->from('no-reply@rotterdam-cloud.com', 'Rotterdam Cloud');
                $message->to($email, $contact);
            });

            (new Audit('Email nieuwe verzoek tot informatie verstuurd', $project->id))->save();
        }
    }
}
