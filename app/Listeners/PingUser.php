<?php

namespace CF\Listeners;

use CF\Events\UserWasPinged;
use Illuminate\Mail\Mailer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PingUser
{
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
     * @param  UserWasPinged  $event
     * @return void
     */
    public function handle(UserWasPinged $event)
    {
		$this->mailer->send('mail.ping', ['event' => $event], function($m) use($event) {
			$m->to($event->reciever->email, $event->reciever->username)->subject('You have been mentioned on Classic Fortress.');
		});
    }
}
