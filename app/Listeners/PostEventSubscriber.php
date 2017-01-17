<?php

namespace App\Listeners;

use App\Events\PostDeleted;
use App\Like;
use App\Post;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use app\Services\PostService;

class PostEventSubscriber
{

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

    // updatuje sa pocet clankov prihlaseneho uzivatela
    public function updateNumOfPosts() {
        // aktualne prihlaseny uzivatel
        $user = Auth::user();
        // pocet vsetkych jeho clankov
        $articles = count($user->posts);
        // aktualizacia poctu clankov v databaze
        $user->num_of_articles = $articles;
        $user->save();
    }

    // aktualizuj priemernu citanost clankov autora clanku
    public function updateReadability($user) {
        // celkovy pocet videni vsetkych clankov uzivatela
        $views = 0;
        // pocet clankov uzivatela
        $allArticles = $user->num_of_articles;

        // prejdu sa vsetky clanky uzivatela
        foreach ($user->posts as $post) {
            $views += $post->unique_views;
        }

        // aktualizuje sa priemerna citanost uzivatela
        $user->avg_readability = $allArticles ? round($views/$allArticles, 2) : 0;
        $user->save();
    }

    // aktualizuj priemernu popularitu clankov uzivatela
    public function updatePopularity($user) {
        // sucet popularit vsetkych clankov
        $popularity = 0;
        // pocet clankov uzivatela
        $allArticles = $user->num_of_articles;

        // prejdu sa vsetky clanky uzivatela
        foreach ($user->posts as $post) {
            $popularity += $post->popularity;
        }

        // aktualizuje sa priemerna popularita uzivatela
        $user->avg_popularity = $allArticles ? round($popularity/$allArticles, 2) : 0;
        $user->save();
    }

    // zvys pocet unikatnych zobrazeni clanku
    public function incrReadability($id) {
        $post = Post::findOrFail($id);
        $post->unique_views++;
        $post->save();
    }

    // kontrola existencie tagu
    public function checkTagExistence($tag) {
        // ak tento tag nema ziadny post, vymazeme ho
        if(!count($tag->posts)) {
            $tag->delete();
        }
    }

    // kontrola existencie kategorie
    public function checkCategoryExistence($category) {
        if( ($category->id > 7) && (count($category->posts) == 0) )
            $category->delete();
    }

     // zvys popularitu clanku
    public function incrPopularity($id, $type) {
        $post = Post::findOrFail($id);

        // ak bol clanok zobrazeny, zvys popularitu o 0.25
        if($type === 'view') {
            $post->popularity += 0.25;
        }

        // ak bol clanok lajknuty, zvys popularitu o 1
        if($type === 'like') {
            $post->popularity++;
        }
        // nakoniec hodnotu uloz
        $post->save();
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
