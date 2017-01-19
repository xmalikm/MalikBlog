<?php

namespace App\Http\ViewComposers;

use App\Post;
use App\User;
use Carbon\Carbon;
use Illuminate\View\View;
use app\Services\CategoryService;

/**
 * Vsetky metody, ktore sa volaju z ComposerServiceProvider-u
 * Kazda metoda definuje a naplni premenne, ktore su zdielane viacerymi views
 * Tieto metody mozu vyuzivat metody zo servisov jenotlivych modelov
 */
class BlogComposer
{

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    // vsetky kategorie clankov
    public function getCategories(View $view)
    {
        $view->with('categories', $this->categoryService->getAllCategories());
    }

    // najcitanejsie clanky za rozne casove obdobia
    public function getMostViewed(View $view) {
        $mostViewed['today'] = Post::with('user')->whereDate('created_at', '=', Carbon::today()->toDateString())->orderBy('unique_views', 'desc')->get();
        $mostViewed['3days'] = Post::with('user')->whereDate('created_at', '>=', Carbon::today()->subDay(2)->toDateString())->orderBy('unique_views', 'desc')->get();
        $mostViewed['7days'] = Post::with('user')->whereDate('created_at', '>=', Carbon::today()->subDay(6)->toDateString())->orderBy('unique_views', 'desc')->get();

        $view->with('mostViewed', $mostViewed);
    }

    // najaktivnejsi uzivatelia(napisali najviac clankov)
    public function getActiveBloggers(View $view) {
        $activeBlogers = User::orderBy('num_of_articles', 'desc')->limit(5)->get();

        $view->with('activeBlogers', $activeBlogers);
    }

    // najnovsie a najpopularnejsie clanky
    public function getNewAndPopular(View $view) {
        $newPopular['newest'] = \App\Post::orderBy('created_at', 'desc')->limit(5)->get();
        $newPopular['mostPopular'] = \App\Post::orderBy('popularity', 'desc')->limit(5)->get();

        $view->with('newPopular', $newPopular);
    }
}