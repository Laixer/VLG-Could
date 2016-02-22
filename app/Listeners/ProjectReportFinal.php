<?php

namespace App\Listeners;

use Mail;
use App\Audit;
use App\Events\ProjectUpdateReport;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProjectReportFinal
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

        if ($report->done) {
            Mail::raw('Email J', function ($message) use ($project, $email, $contact) {
                $message->subject('Subject email J');
                $message->from('no-reply@rotterdam-cloud.com', 'Rotterdam Cloud');
                $message->to($email, $contact);
            });

            (new Audit('Email definitief geupload', $project->id))->save();
        }

    }
}