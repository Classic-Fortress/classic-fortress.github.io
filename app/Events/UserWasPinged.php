<?php

namespace CF\Events;

use CF\Events\Event;
use CF\ForumMessage;
use CF\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserWasPinged extends Event
{
    use SerializesModels;

	public $pinger;
	public $reciever;
	public $post;
	public $link;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $pinger, User $reciever, ForumMessage $message)
    {
		$this->pinger   = $pinger;
        $this->reciever = $reciever;
		$this->post     = $message;


		$this->link  = route('forum.topic', ['forum' => $message->category->slug, 'id' => $message->topic->id, 'topic' => $message->topic->slug ]);
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
