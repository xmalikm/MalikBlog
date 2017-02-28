<?php
/**
 * Trieda obsahuje pomocne metody pre triedu PostEventSubscriber
 * Vacsina metod aktualizuje statistiky bud uzivatela alebo clanku pri
 * jeho vytvoreni, vymazani, zobrazeni, atd.
 */
namespace app\Traits;

use App\Post;
use Illuminate\Support\Facades\Auth;

trait PostEventTrait {

    /**
     *    zvys pocet unikatnych zobrazeni clanku
     */
    public function incrReadability($id) {
        $post = Post::findOrFail($id);
        $post->unique_views++;
        $post->save();
    }

    /**
     *    kontrola existencie tagu
     */
    public function checkTagExistence($tag) {
        // ak tento tag nema ziadny post, vymazeme ho
        if(!count($tag->posts)) {
            $tag->delete();
        }
    }

    /**
     *    kontrola existencie kategorie
     */
    public function checkCategoryExistence($category) {
        if( ($category->id > 7) && (count($category->posts) == 0) )
            $category->delete();
    }

    /**
     *    zvys popularitu clanku
     */
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