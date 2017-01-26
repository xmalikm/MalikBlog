<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

/**
 * Pre definovane views nasej aplikacia vola urcene metody
 * Zabezpecuje zdielanie premennych vo views, zabranuje tak duplicite kodu
 */
class ComposerServiceProvider extends ServiceProvider
{
   
    public function boot()
    {
        /**
         *  Metody pre kategorie
         *
         */

        // menu s kategoriami
        View::composer(
            ['posts.*', 'user.profile', 'categories.indexCategory', 'tags.indexTag', 'user.indexUser'],
            'App\Http\ViewComposers\CategoryComposer@getCategories'
        );

        // asociativne pole vsetkych kategorii v tvare $kategoria[id_kategorie] = nazov_kategorie
        View::composer(
            ['posts.create', 'posts.edit'],
            'App\Http\ViewComposers\CategoryComposer@getCatsArray'
        );

        /**
         *  Metody pre clanky
         *
         */

        // sidebar s najviac citanymi clankami 
        View::composer(
            ['posts.indexPost', 'user.indexUser'],
            'App\Http\ViewComposers\PostComposer@getMostViewed'
        );

        // sidebar s najnovsimi a najpopularnejsimi clankami
        View::composer(
            ['categories.indexCategory'],
            'App\Http\ViewComposers\PostComposer@getNewAndPopular'
        );

        // zobraz dalsie clanky od autora, dalsie clanky z tej istej kategorie
        // a dalsie nove clanky z ostatnych kategorii
        View::composer(
            ['posts.show'],
            'App\Http\ViewComposers\PostComposer@getMorePosts'
        );

        /**
         *  Metody pre uzivatelov
         *
         */

        // sidebar s najviac aktivnymi uzivatelmi(napisali najviac clankov)
        View::composer(
            ['posts.indexPost'],
            'App\Http\ViewComposers\UserComposer@getActiveBloggers'
        );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
