<?php

namespace App\Providers;

use App\Policies\PostPolicy;
use App\Post;
use App\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        //Post::class => PostPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        /**
         * autorizacia editovania komentaru
         * editovat komentar moze iba autor komentaru   
         */
        Gate::define('updateComment', function ($user, $comment) {
            return $user->id == $comment->user_id;
        });

        /**
         * autorizacia editovania clanku
         * editovat clanok moze iba autor clanku   
         */
    	Gate::define ('updatePost', function ($user,  $post) {
    	    return $user->id == $post->user_id;
    	});
    }
}
