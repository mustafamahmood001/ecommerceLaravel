<?php

namespace App\Listeners;

use App\Mail\WelcomeMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendWelcomelistener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle($event)
    {
        $user = $event->user;
        $emailData = [
            'subject' => 'Welcome to ecommerce',
            'body' => 'Welcome to ecommerce. ' . $user->fname . ' ' . $user->lname,
        ];
        Mail::to($user->email)->send(new WelcomeMail($emailData));
    }

}
