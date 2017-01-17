<?php

namespace App\Listeners;

use App\Events\PostDeleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use app\Services\PostService;
use app\Services\UserService;

class PostEventSubscriber
{

    protected $postService;
    protected $userService;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(PostService $postService, UserService $userService)
    {
        $this->postService = $postService;
        $this->userService = $userService;
    }

    /**
     * Handluje event - vytvorenie noveho postu.
     */
    public function onPostCreate($event) {
        // zvys pocet clankov prihlaseneho uzivatela
        $this->userService->updateNumOfPosts();
        // aktualizuj citanost clankov prihlaseneho uzivatela
        $this->userService->updateReadability();
    }

    /**
     * Handluje event - vymazanie postu.
     */
    public function onPostDelete($event) {
        // zvys pocet clankov prihlaseneho uzivatela
        $this->userService->updateNumOfPosts();
        // aktualizuj citanost clankov prihlaseneho uzivatela
        $this->userService->updateReadability();
    }

    /**
     * Handluje event - zobrazenie postu.
     */
    public function onPostView($event) {
       // konkretny post + jeho eager-loadnute zaznamy v tabulke 'views'
        $post = \App\Post::with('views')->find($event->post_id);

        // skontrolovanie kazdeho zaznamu vo 'views'
        foreach ($post->views as $view) {
                // ak sa ip adresy zhoduju, skonci
                if($view->ip == $_SERVER["REMOTE_ADDR"]) {
                    return;
                }
            }

        // vytvor novy 'views' zaznam
        \App\View::create(['ip' => $_SERVER["REMOTE_ADDR"], 'post_id' => $event->post_id]);
        // inkrementuj citanost clanku
        $this->postService->incrReadability($post->id);
        // aktualizuj priemernu citanost autora clanku
        $this->userService->updateReadability($post->user->id);
    }

     /**
     * Vsetky post eventy a ich obsluhujuce metody.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'App\Events\PostCreated',
            'App\Listeners\PostEventSubscriber@onPostCreate'
        );

        $events->listen(
            'App\Events\PostDeleted',
            'App\Listeners\PostEventSubscriber@onPostDelete'
        );

        $events->listen(
            'App\Events\PostViewed',
            'App\Listeners\PostEventSubscriber@onPostView'
        );
    }
}
