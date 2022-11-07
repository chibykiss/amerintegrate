<?php

namespace App\Listeners;

use App\Events\JobCompletedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class MarkSendStatusSent
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
     * @param  \App\Events\JobCompletedEvent  $event
     * @return void
     */
    public function handle(JobCompletedEvent $event)
    {
        //
    }
}
