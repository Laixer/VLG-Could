<?php

namespace App\Listeners;

use Mail;
use Auth;
use App\Audit;
use App\Events\ProjectNewMessage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProjectNewMessageNotification
{
    /**
     * Handle the event.
     *
     * @param  ProjectStatusChange  $event
     * @return void
     */
    public function handle(ProjectNewMessage $event)
    {
        $message = $event->message;
        $project = $message->project;

        $email = $project->resolveContactEmail();
        $contact = $project->resolveContact();

        if (!$email || !$contact)
            return;

        if ($message->user_id == Auth::id())
            return;

        $data = array(
            'project' => $message->project,
            'thread' => $message,
            'email' => $email,
            'contact' => $contact,
        );

        Mail::send('mail.thread_new_message', $data, function ($message) use ($email, $contact) {
            $message->subject('Nieuw bericht bij project');
            $message->from('no-reply@rotterdam-cloud.com', 'Rotterdam Cloud');
            $message->to($email, $contact);
        });

        (new Audit('Email nieuw bericht verstuurd', $project->id))->save();
    }
}
