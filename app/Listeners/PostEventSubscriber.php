<?php

namespace App\Listeners;

use App\Events\PostDeleted;
use App\Like;
use App\Post;
use App\View;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use app\Services\PostService;
use app\Traits\PostEventTrait;

class PostEventSubscriber
{

    use PostEventTrait;

    protected $postService;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * Handluje event - vytvorenie noveho postu.
     */
    public function onPostCreate($event) {
        // aktualizuj pocet clankov prihlaseneho uzivatela
        $this->updateNumOfPosts();
        // aktualizuj priemernu citanost clankov prihlaseneho uzivatela
        $this->updateReadability($event->user);
        // aktualizuj priemernu popularitu clankov prihlaseneho uzivatela
        $this->updatePopularity($event->user);
    }

    /**
     * Handluje event - vymazanie postu.
     */
    public function onPostDelete($event) {
        // kategoria clanku
        $category = $event->post->category;
        // tagy clanku
        $tags = $event->post->tags;
        // aktualizuj pocet clankov prihlaseneho uzivatela
        $this->updateNumOfPosts();
        // aktualizuj priemernu citanost clankov prihlaseneho uzivatela
        $this->updateReadability($event->post->user);
        // aktualizuj priemernu popularitu clankov prihlaseneho uzivatela
        $this->updatePopularity($event->post->user);

        // ak kategoria nepatri mezi zakladnych 6 kategorii a ziaden
        // blog nepatri do tejto kategorie, vymazeme ju
        $this->checkCategoryExistence($category);

        // prejdeme kazdy tag a skontrolujeme ci ho nejaky clanok obsahuje
        foreach ($tags as $tag) {
            $this->checkTagExistence($tag);
        }
        Like::where('likeable_id', $event->post->id)->where('likeable_type', 'App\Post')->delete();
    }

    /**
     * Handluje event - zobrazenie postu.
     */
    public function onPostView($event) {
       // konkretny post + jeho eager-loadnute zaznamy v tabulke 'views'
        $post = Post::with('views')->find($event->post_id);

        // skontrolovanie kazdeho zaznamu vo 'views'
        foreach ($post->views as $view) {
                // ak sa ip adresy zhoduju, skonci
                if($view->ip == $_SERVER["REMOTE_ADDR"]) {
                    return;
                }
            }

        // vytvor novy 'views' zaznam
        View::create(['ip' => $_SERVER["REMOTE_ADDR"], 'post_id' => $event->post_id]);
        // inkrementuj citanost clanku
        $this->incrReadability($post->id);
        // inkrementuj popularitu clanku zobrazenim
        $this->incrPopularity($post->id, 'view');
        // aktualizuj priemernu citanost autora clanku
        $this->updateReadability($post->user);
        // aktualizuj priemernu popularitu clankov prihlaseneho uzivatela
        $this->updatePopularity($post->user);
    }

    public function onPostLike($event) {
        $post = Post::findOrFail($event->post_id);
        // inkrementuj popularitu clanku lajknutim
        $this->incrPopularity($event->post_id, 'like');
        // aktualizuj priemernu popularitu clankov prihlaseneho uzivatela
        $this->updatePopularity($post->user);
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

        $events->listen(
            'App\Events\PostLiked',
            'App\Listeners\PostEventSubscriber@onPostLike'
        );
    }
}
