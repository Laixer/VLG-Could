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

        $email = $project->resolveContactEmail();
        $contact = $project->resolveContact();

        if (!$email || !$contact)
            return;

        if (!$project->todoAvailableForAttach()->count()) {
            Mail::raw('Email E', function ($message) use ($project) {
                $message->subject('Subject email E');
                $message->from('no-reply@rotterdam-cloud.com', 'Rotterdam Cloud');
                $message->to($email, $contact);
            });

            (new Audit('Email alle bestanden aanwezig', $project->id))->save();
        }
    }
}
