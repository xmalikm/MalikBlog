<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

/**
 * Service provider pre nas blog
 * Pre definovane views nasej aplikacia vola urcene metody
 * Zabezpecuje zdielanie premennych vo views, zabranuje tak duplicite kodu
 */
class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // menu s kategoriami
        View::composer(
            ['posts.*', 'profile', 'categories.indexCategory', 'tags.indexTag', 'user.indexUser'],
            'App\Http\ViewComposers\BlogComposer@getCategories'
        );

        // sidebar s najviac citanymi clankami 
        View::composer(
            ['posts.indexPost', 'user.indexUser'],
            'App\Http\ViewComposers\BlogComposer@getMostViewed'
        );

        // sidebar s najviac aktivnymi uzivatelmi(napisali najviac clankov)
        View::composer(
            ['posts.indexPost'],
            'App\Http\ViewComposers\BlogComposer@getActiveBloggers'
        );

        // sidebar s najnovsimi a najpopularnejsimi clankami
        View::composer(
            ['categories.indexCategory'],
            'App\Http\ViewComposers\BlogComposer@getNewAndPopular'
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
