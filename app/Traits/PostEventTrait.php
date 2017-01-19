<?php

namespace app\Traits;

use App\Post;
use Illuminate\Support\Facades\Auth;

/**
 * Trieda obsahuje pomocne metody pre triedu PostEventSubscriber
 * Vacsina metod aktualizuje statistiky bud uzivatela alebo clanku pri
 * jeho vytvoreni, vymazani, zobrazeni, atd.
 */
trait PostEventTrait {

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

}