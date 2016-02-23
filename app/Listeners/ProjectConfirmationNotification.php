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
        $project_contact = $project->resolveContactObject();

        foreach ($project->resolveInvolvedObjects() as $user) {
            if ($project_contact['id'] != $user['id']) {

                $email = $user['email'];
                $contact = $user['name'] . ' ' . $user['last_name'];

                $data = array(
                    'project' => $project,
                    'email' => $email,
                    'contact' => $contact,
                );

                Mail::send('mail.project_confirmed', $data, function ($message) use ($email, $contact) {
                    $message->subject('Subject email P');
                    $message->from('no-reply@rotterdam-cloud.com', 'Rotterdam Cloud');
                    $message->to($email, $contact);
                });

                (new Audit('Email project bevestiging verstuurd', $project->id))->save();
            }
        }
    }
}
