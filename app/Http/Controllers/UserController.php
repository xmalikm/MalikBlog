<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveUserRequest;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Image;
use app\Services\CategoryService;
use app\Services\UserService;

class UserController extends Controller
{

    public $userService;
    public $categoryService;

    public function __construct(UserService $userService, CategoryService $categoryService) {
        $this->userService = $userService;
        $this->categoryService = $categoryService;
        $this->middleware('auth', ['except' => ['showUserProfile', 'index']]);
    }

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
            ->with('user', $user);
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

    public function destroy() {
        if($this->userService->deleteProfile()) {
            return Redirect::route('login')
                ->with('userDeleted', 'Je nám ľúto že odchádzate :(');
        }

    }

    public function sortMessage($sortBy, $sortFrom) {
        return 'Zoradené podľa <b>'. $sortBy .'</b> od <b>'. $sortFrom .'</b>';
    }

    public function sortBlogers(Request $request) {
        // stlpec, podla ktoreho sa ma triedit
        $sortBy = $request->input('sortBy');
        // sposob triedenia(asc, desc)
        $sortFrom = $request->input('sortFrom');

        // dva stringy, ktore budeme vypisovat ako informaciu pre uzivatela
        // su to hodnoty select option tagov - teda kriteria triedenia
        $sortByMsg = $request->input('sortByMsg');
        $sortFromMsg = $request->input('sortFromMsg');

        // string, ktory bude vypisany ako informacie pre usera podla coho sa sortovalo
        $title = $this->sortMessage($sortByMsg, $sortFromMsg);
    
        if($sortBy === 'created_at')
            $users = User::orderBy($sortBy, $sortFrom)->get();
        else
            $users = User::leftJoin('posts', 'users.id', '=', 'posts.user_id')
                ->select('users.id', 'users.name', 'users.profile_photo', DB::raw('avg(posts.'. $sortBy .') as '.$sortBy))
                ->orderBy($sortBy, $sortFrom)
                ->groupBy('users.id')
                ->groupBy('users.name')
                ->groupBy('users.profile_photo')->get();

        return view('user.indexUser')
            ->with([
                'users' => $users,
                'title' => $title,
            ]);
    }

}