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
     * Handluje event - vymazanie postu.
     */
    public function onPostDelete($event) {
        $post_id = $event->post->id;
        // kategoria clanku
        $category = $event->post->category;
        // tagy clanku
        $tags = $event->post->tags;
        
        // ak kategoria nepatri mezi zakladnych 6 kategorii a ziaden
        // blog nepatri do tejto kategorie, vymazeme ju
        $this->checkCategoryExistence($category);

        // prejdeme kazdy tag a skontrolujeme ci ho nejaky clanok obsahuje
        foreach ($tags as $tag) {
            $this->checkTagExistence($tag);
        }
        
        Like::whereIn('likeable_id', function($query) use ($post_id) {
            $query->select('id')
                  ->from('comments')
                  ->where('post_id', $post_id);
        })->orWhere('likeable_id', $post_id)->delete();
    }

    /**
     * Handluje event - zobrazenie postu.
     */
    public function onPostView($event) {
       // konkretny post + jeho eager-loadnute zaznamy v tabulke 'views'
        $post = Post::with('views')->findOrFail($event->post_id);

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
    }

    public function onPostLike($event) {
        $post = Post::findOrFail($event->post_id);
        // inkrementuj popularitu clanku lajknutim
        $this->incrPopularity($event->post_id, 'like');
    }

     /**
     * Vsetky post eventy a ich obsluhujuce metody.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
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
