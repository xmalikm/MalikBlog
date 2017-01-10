<?php

namespace App\Listeners;

use App\Events\PostViewed;
use App\Post;
use App\View;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class HandlePostViews
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
     * @param  PostViewed  $event
     * @return void
     */
    public function handle(PostViewed $event)
    {
        // konkretny post + jeho eager-loadnute zaznamy v tabulke 'views'
        $post = Post::with('views')->find($event->post_id);

        // skontrolovanie kazdeho zaznamu vo 'views'
        foreach ($post->views as $view) {
                // ak sa ip adresy zhoduju, skonci
                if($view->ip == $_SERVER["REMOTE_ADDR"]) {
                    return;
                }
            }

        View::create(['ip' => $_SERVER["REMOTE_ADDR"], 'post_id' => $event->post_id]);
        $post->hit();
    }
}
