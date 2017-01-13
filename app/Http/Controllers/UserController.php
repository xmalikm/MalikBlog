<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveUserRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;
use app\Services\UserService;

class UserController extends Controller
{

    public $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
        $this->middleware('auth', ['except' => ['showUserProfile']]);
    }

	// informacie o zaregistrovanom uzivatelovi, ktore su dostupe pre kazdeho
    public function showUserProfile($id) {

    	// ak sa nepodari najst uzivatela -> vrat 404
    	$user = User::findOrFail($id);

    	return view('profile')
    		->with('title', "Profil uživateľa " . "<b>" . $user->name . "</b>")
    		->with('user', $user);
    }

    // stranka s udajmi o aktualne prihlasenom uzivatelovi, ktora je dostupna
    // iba pre uzivatela daneho profilu
    public function show() {
    	// aktualne prihlaseny uzivatel
    	$user = $this->userService->getLoggedUser();

    	return view('user.showMyProfile')
    		->with('user', $user)
    		->with('title', $user->name);
    }

    // formular pre zmenu udajov
    public function edit() {
        // aktualne prihlaseny uzivatel
        $user = $this->userService->getLoggedUser();

        return view('user.editMyProfile')
            ->with('user', $user)
            ->with('title', "Zmena udajov");
    }

    // samotna zmena udajov
    public function update(SaveUserRequest $request) {
        // update metoda user servisu
        $user = $this->userService->updateProfile($request);

        return view('user.showMyProfile')
            ->with('user', $user)
            ->with('title', $user->name);
    }

}