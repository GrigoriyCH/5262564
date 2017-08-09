<?php

namespace Japblog\Events;
use Japblog\Posts;
use Japblog\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PostHasViewed extends Event
{
    use SerializesModels;
	public $post;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Posts $post)
    {
        //
		$this->post = $post;
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
