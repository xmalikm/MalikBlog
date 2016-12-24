<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

	// informacie o zaregistrovanom uzivatelovi, ktore su dostupe pre kazdeho
    public function showUserProfile($id) {
    	// ak sa nepodari najst uzivatela -> vrat 404
    	$user = User::findOrFail($id);

    	return view('profile')
    		->with('title', "Profil uživateľa " . "<b>" . $user->name . "</b>")
    		->with('user', $user);
    }

    // stranka s udajmi o uzivatelovi, ktora je dostupna iba pre uzivatela daneho profilu
    public function showMyProfile() {
    	// aktualne prihlaseny uzivatel
    	$user = Auth::user();

    	return view('user.showMyProfile')
    		->with('user', $user)
    		->with('title', $user->name);
    }

}