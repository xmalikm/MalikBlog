<?php

namespace App\Listeners;

use App\Events\PostDeleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use app\Services\UserService;

class DecNumOfPosts
{
    protected $userService;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Handle the event.
     *
     * @param  PostDeleted  $event
     * @return void
     */
    public function handle(PostDeleted $event)
    {
        // zniz o 1 pocet clankov prihlaseneho uzivatela
        $this->userService->decNumOfArticles();
        // aktualizuj citanost clankov prihlaseneho uzivatela
        $this->userService->updateReadability();
    }
}
