<?php

namespace App\Listeners;

use Mail;
use Carbon\Carbon;
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
    private function InformationRequestFirst($project, $email, $contact)
    {
        Mail::raw('Email B', function ($message) use ($project, $email, $contact) {
            $message->subject('Subject email B');
            $message->from('no-reply@rotterdam-cloud.com', 'Rotterdam Cloud');
            $message->to($email, $contact);
        });

        (new Audit('Email 1ste herinnering verzoek tot informatie verstuurd', $project->id))->save();
    }

    private function InformationRequestSecond($project, $email, $contact)
    {
        Mail::raw('Email C', function ($message) use ($project, $email, $contact) {
            $message->subject('Subject email C');
            $message->from('no-reply@rotterdam-cloud.com', 'Rotterdam Cloud');
            $message->to($email, $contact);
        });

        (new Audit('Email 2de herinnering verzoek tot informatie verstuurd', $project->id))->save();
    }

    private function InformationRequestLast($project, $email, $contact)
    {
        Mail::raw('Email D', function ($message) use ($project, $email, $contact) {
            $message->subject('Subject email D');
            $message->from('no-reply@rotterdam-cloud.com', 'Rotterdam Cloud');
            $message->to($email, $contact);
        });

        (new Audit('Email laatste herinnering verzoek tot informatie verstuurd', $project->id))->save();
    }

    /**
     * Handle the event.
     *
     * @param  ProjectReminder  $event
     * @return void
     */
    private function ConceptReminderFirst($project, $email, $contact)
    {
        Mail::raw('Email G', function ($message) use ($project, $email, $contact) {
            $message->subject('Subject email G');
            $message->from('no-reply@rotterdam-cloud.com', 'Rotterdam Cloud');
            $message->to($email, $contact);
        });

        (new Audit('Email 1ste herinnering concept verstuurd', $project->id))->save();
    }

    private function ConceptReminderSecond($project, $email, $contact)
    {
        Mail::raw('Email H', function ($message) use ($project, $email, $contact) {
            $message->subject('Subject email H');
            $message->from('no-reply@rotterdam-cloud.com', 'Rotterdam Cloud');
            $message->to($email, $contact);
        });

        (new Audit('Email 2de herinnering concept verstuurd', $project->id))->save();
    }

    private function ConceptRemindertLast($project, $email, $contact)
    {
        Mail::raw('Email I', function ($message) use ($project, $email, $contact) {
            $message->subject('Subject email I');
            $message->from('no-reply@rotterdam-cloud.com', 'Rotterdam Cloud');
            $message->to($email, $contact);
        });

        (new Audit('Email laatste herinnering concept verstuurd', $project->id))->save();
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
            $email = $project->resolveContactEmail();
            $contact = $project->resolveContact();

            if (!$email || !$contact)
                continue;

            $expire = $project->updated_at->addDays($project->email_interval_1);
            $expire2 = $project->updated_at->addDays($project->email_interval_1 * 2);
            $expire3 = $project->updated_at->addDays($project->email_interval_2);

            /* 
             * Conditions:
             * - Project status is Request For information
             * - Todo items available
             */
            if ($project->status->priority == 2 && !$project->todoAllDone()) {
                // if (Carbon::now()->gt($expire3))
                    $this->InformationRequestLast($project, $email, $contact);

                // else if (Carbon::now()->gt($expire2))
                    $this->InformationRequestSecond($project, $email, $contact);

                // else if (Carbon::now()->gt($expire))
                    $this->InformationRequestFirst($project, $email, $contact);
            }

            /* 
             * Conditions:
             * - Project has concept
             * - Project has no final
             * - Project condition is not set
             */
            // echo 'Concepten: ' . $project->reports()->whereNotNull('version')->count();
            // echo 'Finals: ' . $project->reports()->where('done', true)->count();
            // die();
            if ($project->reports()->whereNotNull('version')->count() > 0 && $project->reports()->where('done', true)->count() == 0 && $project->confirmed == -1) {
                // if (Carbon::now()->gt($expire3))
                    $this->ConceptRemindertLast($project, $email, $contact);

                // else if (Carbon::now()->gt($expire2))
                    $this->ConceptReminderSecond($project, $email, $contact);

                // else if (Carbon::now()->gt($expire))
                    $this->ConceptReminderFirst($project, $email, $contact);
            }
        }
    }

}
