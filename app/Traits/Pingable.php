<?php

namespace CF\Traits;

use CF\Events\UserWasPinged;
use CF\ForumMessage;
use CF\Ping;
use CF\User;

trait Pingable
{

	protected static function boot()
	{
		parent::boot();

		static::created(function($item){

			$pinger = $item->author()->first();
			$message = ForumMessage::with(['topic','category'])->find($item->id);

			foreach (checkUsernames($item->body) as $username)
			{
				if($user = User::with('settings')->where('username', $username)->first() and $user->settings->mail_pings)
				{
					if(! Ping::where('reciever_id', $user->id)->where('message_id', $item->id)->first())
					{
						event(new UserWasPinged($pinger, $user, $message));
						Ping::create([
							'reciever_id' => $user->id,
							'pinger_id'   => $pinger->id,
							'message_id'  => $item->id
						]);
					}
				}
			}


		});
	}

}