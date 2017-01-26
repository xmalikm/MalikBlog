<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveUserRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use app\Services\UserService;

class UserController extends Controller
{

    public $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
        $this->middleware('auth', ['except' => ['showUserProfile', 'index']]);
    }

    // vylistovanie vsetkych uzivatelov
    public function index() {
        $users = User::all();
      
        return view('user.indexUser')
            ->with([
                'users' => $users,
                'title' => 'Všetci blogery',
            ]);
    }

    // zoznam blogov aktualne prihlaseneho uzivatela
    public function myPosts() {
        $user = Auth::user();

        return view('user.showMyPosts')
            ->with('posts', $user->posts);
    }

    // stranka s udajmi o aktualne prihlasenom uzivatelovi, ktora je dostupna
    // iba pre uzivatela daneho profilu
    public function show() {
        // aktualne prihlaseny uzivatel
        $user = Auth::user();

        return view('user.showMyProfile')
            ->with('user', $user)
            ->with('title', $user->name);
    }

	// informacie o zaregistrovanom uzivatelovi, ktore su dostupe pre kazdeho
    public function showUserProfile($id) {

    	$user = User::findOrFail($id);

    	return view('user.profile')
    		->with('title', "Profil uživateľa " . "<b>" . $user->name . "</b>")
    		->with('user', $user);
    }

    // formular pre zmenu udajov prihlaseneho uzivatela
    public function edit() {
        // aktualne prihlaseny uzivatel
        $user = Auth::user();

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

    // zmazanie uctu uzivatela
    public function destroy() {
        if($this->userService->deleteProfile()) {
            return Redirect::route('login')
                ->with('userDeleted', 'Je nám ľúto že odchádzate :(');
        }
    }

    // zoradi a vrati uzivatelov podla danych kriterii
    public function sortBlogers(Request $request) {
        // dva stringy, ktore budeme vypisovat ako informaciu pre uzivatela
        // su to hodnoty select option tagov - teda kriteria triedenia
        $sortByMsg = $request->input('sortByMsg');
        $sortFromMsg = $request->input('sortFromMsg');

        // string, ktory bude vypisany ako informacie pre usera podla coho sa sortovalo
        $title = $this->sortMessage($sortByMsg, $sortFromMsg);
    
        // z user servisu si vratime zoradenych uzivatelov
        $users = $this->userService->getSortedBloggers($request);

        return view('user.indexUser')
            ->with([
                'users' => $users,
                'title' => $title,
            ]);
    }

    // metoda vracia ako string informaciu o tom, podla coho sa zoraduje
    // a akym sposobom sa zoraduje
    // sluzi pre informovanie uzivatela
    public function sortMessage($sortBy, $sortFrom) {
        return 'Zoradené podľa <b>'. $sortBy .'</b> od <b>'. $sortFrom .'</b>';
    }

}