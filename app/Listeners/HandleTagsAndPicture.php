<?php

namespace App\Listeners;

use App\Events\BlogCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class HandleTagsAndPicture
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
     * @param  BlogCreated  $event
     * @return void
     */
    public function handle(BlogCreated $event)
    {
        Log::debug($event->post);
    }
}
