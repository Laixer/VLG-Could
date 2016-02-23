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
        $project_contact = $project->resolveContactObject();

        if ($project->status->priority == 5) {

            $exist = false;
            $users = $project->resolveInvolvedObjects();
            foreach ($users as $user) {
                if ($project_contact['id'] == $user['id']) {
                    $exist = true;
                    break;
                }
            }

            if (!$exist)
                array_push($users, $project_contact);

            foreach ($users as $user) {
                $email = $user['email'];
                $contact = $user['name'] . ' ' . $user['last_name'];

                $data = array(
                    'project' => $project,
                    'email' => $email,
                    'contact' => $contact,
                );

                Mail::send('mail.project_close', $data, function ($message) use ($email, $contact) {
                    $message->subject('Subject email M');
                    $message->from('no-reply@rotterdam-cloud.com', 'Rotterdam Cloud');
                    $message->to($email, $contact);
                });

                (new Audit('Email project gesloten verstuurd', $project->id))->save();
            }
        }
    }
}
