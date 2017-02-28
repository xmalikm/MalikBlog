<?php
/**
 * Service class User modelu
 * Obsahuje celu business logiku modelu
 */
namespace app\Services;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use app\Services\BaseService;

class UserService extends BaseService{

	protected $user;

	public function __construct() {
		//
	}

    /**
     *    update profilu prihlaseneho uzivatela
     */
	public function updateProfile($request) {
		// prihlaseny uzivatel
        $this->user = Auth::user();

        // update vsetkych udajov uzivatela okrem profilovej fotky
        $this->user->update($request->except(['profile_photo']));

        // update profilovej fotky
        if($request->hasFile('profile_photo')) {
            $fileName = $this->setPhoto($request->file('profile_photo'), $this->user);

            // ak si uzivatel zmenil profilovu fotku, staru fotku vymazeme
            $this->deletePhoto($this->user);
            // nazov obrazku je ulozeny fo db
            $this->user->profile_photo = $fileName;
        }

        // nakoniec ulozime model
        $this->user->save();

        return $this->user;
	}

    /**
     *    vymazanie profilu prihlaseneho uzivatela
     */
    public function deleteProfile() {
        // prihlaseny uzivatel
        $this->user = Auth::user();
        // odhlasenie uzivatela
        Auth::logout();

        if($this->user->delete()) {
            $this->deletePhoto($this->user);
            return true;
        }
        else
            return false;
    }

    /**
     *    zoradi a vrati uzivatelov podla kriterii
     */
    public function getSortedBloggers($request) {
        // stlpec, podla ktoreho sa ma triedit
        $sortBy = $request->input('sortBy');
        // sposob triedenia(asc, desc)
        $sortFrom = $request->input('sortFrom');

        // ak sa zoraduje podla datumu zalozenia uctu
        if($sortBy === 'created_at') {
            $users = User::orderBy($sortBy, $sortFrom)->get();
        }
        // pri ostatnych sposoboch zoradovania zorad takto
        else {
            $users = User::leftJoin('posts', 'users.id', '=', 'posts.user_id')
                ->select('users.id', 'users.name', 'users.profile_photo', DB::raw('avg(posts.'. $sortBy .') as '.$sortBy))
                ->orderBy($sortBy, $sortFrom)
                ->groupBy('users.id')
                ->groupBy('users.name')
                ->groupBy('users.profile_photo')->get();
        }

        return $users;
    }

}