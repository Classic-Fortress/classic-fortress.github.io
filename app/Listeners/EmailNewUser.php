<?php

namespace CF\Listeners;

use CF\Events\UserRegistered;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailNewUser
{

	protected $mailer;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Handle the event.
     *
     * @param  UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        $this->mailer->send('mail.welcome', ['username' => $event->user->username], function($m) use($event) {
			$m->to($event->user->email, $event->user->username)->subject('Welcome to Classic Fortress!');
		});
    }
}
