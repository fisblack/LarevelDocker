<?php

namespace SenseBook\Listeners\BackOffice\Member;

use Illuminate\Support\Facades\Mail;
use SenseBook\Events\BackOffice\Member\UserCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendPasswordEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserCreated  $event
     * @return void
     */
    public function handle(UserCreated $event)
    {
        Mail::send('emails.sendPasswordEmail', [
            'user' => $event->user,
            'password' => $event->password
        ], function ($message) use ($event) {
            $message->to($event->user->email)->subject('Your Account Information');
        });
    }
}
