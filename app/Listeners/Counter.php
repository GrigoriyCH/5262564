<?php

namespace Japblog\Listeners;

use Japblog\Events\PostHasViewed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class Counter
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
     * @param  PostHasViewed  $event
     * @return void
     */
    public function handle(PostHasViewed $event)
	{
		$event->post->increment('view');
	}
}
