<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveUserRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;

class UserController extends Controller
{

    public function __construct() {
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

    // stranka s udajmi o aktualne prihlasenom uzivatelovi, ktora je dostupna iba pre uzivatela daneho profilu
    public function show() {
    	// aktualne prihlaseny uzivatel
    	$user = Auth::user();

    	return view('user.showMyProfile')
    		->with('user', $user)
    		->with('title', $user->name);
    }

    // formular pre zmenu udajov
    public function edit() {
        // aktualne prihlaseny uzivatel
        $user = Auth::user();

        return view('user.editMyProfile')
            ->with('user', $user)
            ->with('title', "Zmena udajov");
    }

    // samotna zmena udajov
    public function update(SaveUserRequest $request) {
        $user = Auth::user();
        $user->update($request->except(['profile_photo']));
        if($request->hasFile('profile_photo')) {
            $fileName = $this->setProfilePhoto($request->file('profile_photo'));
            // nazov obrazku je ulozeny fo db
            $user->profile_photo = $fileName;
            $user->save();
        }

        return view('user.showMyProfile')
            ->with('user', $user)
            ->with('title', $user->name);
    }

     public function setProfilePhoto($profilePhoto) {
        $fileName = time() . '.' . $profilePhoto->getClientOriginalExtension();
        Image::make($profilePhoto)->resize(500, 300)->save( public_path('uploads/profile_photos/' . $fileName));

        return $fileName;
    }

}