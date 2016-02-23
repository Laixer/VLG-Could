<?php

namespace App\Listeners;

use Mail;
use App\Audit;
use App\Events\ProjectUpdateReport;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProjectReportTodoComplete
{
    /**
     * Handle the event.
     *
     * @param  ProjectUpdateReport  $event
     * @return void
     */
    public function handle(ProjectUpdateReport $event)
    {
        $report = $event->report;
        $project = $report->project;
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

                Mail::send('mail.todo_complete', $data, function ($message) use ($email, $contact) {
                    $message->subject('Subject email E');
                    $message->from('no-reply@rotterdam-cloud.com', 'Rotterdam Cloud');
                    $message->to($email, $contact);
                });

                (new Audit('Email alle bestanden aanwezig verstuurd', $project->id))->save();
            }
        }
    }
}
