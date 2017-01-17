<?php

namespace app\Services;

use App\User;
use Illuminate\Support\Facades\Auth;
use app\Services\BaseService;

/**
 * Service class User modelu
 * Obsahuje celu business logiku modelu
 */
class UserService extends BaseService{

	protected $user;

	public function __construct() {
		//
	}

    // update profilu prihlaseneho uzivatela
	public function updateProfile($request) {
		// prihlaseny uzivatel
        $this->user = $this->getLoggedUser();

        // update vsetkych udajov uzivatela okrem profilovej fotky
        $this->user->update($request->except(['profile_photo']));

        // update profilovej fotky
        if($request->hasFile('profile_photo')) {
            $fileName = $this->setPhoto($request->file('profile_photo'), $this->user);

            // ak si uzivatel zmenil profilovu fotku, staru fotku vymazeme
            $this->deletePhoto($this->user);

            // nazov obrazku je ulozeny fo db
            $this->user->profile_photo = $fileName;
            $this->user->save();
        }

        return $this->user;
	}

    // vymazanie profilu prihlaseneho uzivatela
    public function deleteProfile() {
        // prihlaseny uzivatel
        $this->user = $this->getLoggedUser();
        // odhlasenie uzivatela
        Auth::logout();

        if($this->user->delete()) {
            $this->deletePhoto($this->user);
            return true;
        }
        else
            return false;
    }

    public function updateReadability() {
        $this->user = $this->getLoggedUser();
        // celkovy pocet videni vsetkych clankov usera
        $count = 0;
        // pocet clankov usera
        $allArticles = $this->user->num_of_articles;

        foreach ($this->user->posts as $post) {
            $count += $post->unique_views;
        }

        $this->user->avg_readability = $allArticles ? round($count/$allArticles, 2) : 0;
        $this->user->save();
    }

    // updatuje sa pocet clankov prihlaseneho uzivatela
    public function updateNumOfPosts() {
        // aktualne prihlaseny uzivatel
        $this->user = $this->getLoggedUser();        
        // pocet vsetkych jeho clankov
        $articles = count($this->user->posts);
        // aktualizacia poctu clankov v databaze
        $this->user->num_of_articles = $articles;
        $this->user->save();
    }

}