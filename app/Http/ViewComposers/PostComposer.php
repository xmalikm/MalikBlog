<?php

namespace App\Http\ViewComposers;

use App\Category;
use App\Post;
use Carbon\Carbon;
use Illuminate\View\View;

/**
 * Metody suvisiace so zobrazovanim clankov, ktore sa volaju z ComposerServiceProvider-u
 * Kazda metoda naplni premenne, ktore su zdielane viacerymi views, ktore zobrazuju clanky
 */
class PostComposer
{

    public function __construct()
    {
        //
    }

    // najcitanejsie clanky za rozne casove obdobia
    public function getMostViewed(View $view) {
        $mostViewed['today'] = Post::with('user')
            ->whereDate('created_at', '=', Carbon::today()->toDateString())
            ->orderBy('unique_views', 'desc')
            ->get();

        $mostViewed['3days'] = Post::with('user')
            ->whereDate('created_at', '>=', Carbon::today()->subDay(2)->toDateString())
            ->orderBy('unique_views', 'desc')
            ->get();

        $mostViewed['7days'] = Post::with('user')
            ->whereDate('created_at', '>=', Carbon::today()->subDay(6)->toDateString())
            ->orderBy('unique_views', 'desc')
            ->get();

        $view->with('mostViewed', $mostViewed);
    }

    // najnovsie a najpopularnejsie clanky
    public function getNewAndPopular(View $view) {
        $newPopular['newest'] = \App\Post::orderBy('created_at', 'desc')->limit(5)->get();
        $newPopular['mostPopular'] = \App\Post::orderBy('popularity', 'desc')->limit(5)->get();

        $view->with('newPopular', $newPopular);
    }

    // zobraz dalsie clanky od autora, dalsie clanky z tej istej kategorie
    // a dalsie nove clanky z ostatnych kategorii
    public function getMorePosts(View $view) {
        // model postu, ktory je posielany do view
        $post = $view->getData()['post'];

        // vracia najnovsi clanok z prvych styroch kategorii, ktore obsahuju nejaky clanok
        $recentPosts = $this->getRecentPosts($post);

        $view->with([
            'postsFromAuthor' => $post->user->posts->where('id', '!=', $post->id)->take(5), // dalsie clanky autora
            'postsFromCat' => $post->category->posts->where('id', '!=', $post->id)->take(5), // dalsie clanky z danej kategorie
            'recentPosts' => $recentPosts, // dalsie nove clanky z roznych kategorii
            ]);
    }

    // vracia najnovsi clanok z prvych styroch kategorii, ktore obsahuju nejaky clanok
    public function getRecentPosts($viewedPost) {
        $categories = Category::all();
        // pole postov, bude obsahovat 4 posty - jeden z kazdej kategorie
        $recentPosts = [];

        foreach ($categories as $category) {
            // ak uz pole obsahuje pozadovany pocet postov, vykona sa break z loopu
            if(count($recentPosts) == 4)
                break;

            // kontroluje, ci kategoria obsahuje clanok
            // ak ano, vlozi ho do pola
            // ak nie, pokracuje sa v cykle
            // tym sa zabrani tomu, ze pole by obsahovalo nullove hodnoty
            if(count($category->posts)) {
                // najde sa prvy clanok z kategorie, iny ako aktualne prezerany clanok
                foreach ($category->posts->sortByDesc('created_at') as $catPost) {
                    // ak je to ten isty clanok ako prezerany clanok, pokracuj v hladani
                    if($catPost->id == $viewedPost->id)
                        continue;
                    else {
                        // ak sa nasiel clanok, vyskoci sa z cyklu a prejde sa na dalsiu kategoriu
                        array_push($recentPosts, $catPost);
                        break;
                    }
                }
            }
            else
                continue;
        }
        
        return $recentPosts;
    }
}