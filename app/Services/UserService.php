<?php

namespace app\Services;

use app\Services\BaseService;

/**
 * Service class User modelu
 * Obsahuje celu business logiku modelu
 */
class UserService extends BaseService{

	// repozitar modelu
	protected $userRepo;
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
            // nazov obrazku je ulozeny fo db
            $this->user->profile_photo = $fileName;
            $this->user->save();
        }

        return $this->user;
	}

}