<?php

namespace App\Listeners;

use Mail;
use App\Audit;
use App\Events\ProjectUpdateReport;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProjectReportConcept
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

        if ($report->version) {
            Mail::raw('Email F', function ($message) use ($project, $email, $contact) {
                $message->subject('Subject email F');
                $message->from('no-reply@rotterdam-cloud.com', 'Rotterdam Cloud');
                $message->to($email, $contact);
            });

            (new Audit('Email concept geupload verstuurd', $project->id))->save();
        }

    }
}
