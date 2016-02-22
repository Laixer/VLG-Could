<?php

namespace App\Listeners;

use Mail;
use App\Audit;
use App\Events\ProjectReminder;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProjectReminderNotification
{

    /**
     * Handle the event.
     *
     * @param  ProjectReminder  $event
     * @return void
     */
    private function InformationRequestFirst()
    {
        // 
    }

    private function InformationRequestSecond()
    {
        // 
    }

    private function InformationRequestLast()
    {
        // 
    }

    /**
     * Handle the event.
     *
     * @param  ProjectReminder  $event
     * @return void
     */
    private function ConceptReminderFirst()
    {
        // 
    }

    private function ConceptReminderSecond()
    {
        // 
    }

    private function ConceptRemindertLast()
    {
        // 
    }

    /**
     * Handle the event.
     *
     * @param  ProjectReminder  $event
     * @return void
     */
    public function handle(ProjectReminder $event)
    {
        foreach ($event->projects as $project) {
            // print($project);
        }

        // $email = $project->resolveContactEmail();
        // $contact = $project->resolveContact();

        // if (!$email || !$contact)
        //     return;

        // Mail::raw('Email A', function ($message) use ($project, $email, $contact) {
        //     $message->subject('Subject email A');
        //     $message->from('no-reply@rotterdam-cloud.com', 'Rotterdam Cloud');
        //     $message->to($email, $contact);
        // });

        // (new Audit('Email nieuwe projectstatus verstuurd', $project->id))->save();
    }
}
