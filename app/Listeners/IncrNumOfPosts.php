<?php

namespace App\Listeners;

use App\Events\PostCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use app\Services\UserService;

class IncrNumOfPosts
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
     * @param  PostCreated  $event
     * @return void
     */
    public function handle(PostCreated $event)
    {
        // zvys pocet clankov prihlaseneho uzivatela
        $this->userService->incrNumOfArticles();
        // aktualizuj citanost clankov prihlaseneho uzivatela
        $this->userService->updateReadability();
    }
}
