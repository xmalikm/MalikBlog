<?php

namespace App\Http\ViewComposers;

use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

/**
 * Metody suvisiace so zobrazovanim uzivatelov, ktore sa volaju z ComposerServiceProvider-u
 * Kazda metoda naplni premenne, ktore su zdielane viacerymi views, ktore zobrazuju info o uzivateloch
 */
class UserComposer
{

    public function __construct()
    {
        //
    }
   
    // najaktivnejsi uzivatelia(napisali najviac clankov)
    public function getActiveBloggers(View $view) {
        $activeBlogers = User::leftJoin('posts', 'users.id', '=', 'posts.user_id')
                ->select('users.id', 'users.name', 'users.profile_photo', DB::raw('count(posts.id) as countPosts'))
                ->orderBy('countPosts', 'desc')
                ->groupBy('users.id')
                ->groupBy('users.name')
                ->groupBy('users.profile_photo')->get();
        
        $view->with('activeBlogers', $activeBlogers);
    }

}