<?php

namespace app\Services;

use App\Post;
use App\User;
use Illuminate\Support\Facades\Auth;
use Image;

/**
 * Base Service class
 * 
 */
class BaseService {

	public function __construct() {
		//
	}

	// aktualne prihlaseny uzivatel
	public function getLoggedUser() {
		return Auth::user();
	}

	// vytvorenie obrazku, nahrateho userom
    // ulozenie obrazku do daneho folder-u
    // return nazvu suboru
    public function setPhoto($photo, $model) {
        $fileName = time() . '.' . $photo->getClientOriginalExtension();
        if($model instanceof Post)
        	Image::make($photo)->resize(500, 300)->save( public_path('uploads/blog_photos/' . $fileName));
        else if($model instanceof User)
        	Image::make($photo)->resize(500, 300)->save( public_path('uploads/profile_photos/' . $fileName));
        else
        	return null;

        return $fileName;
    }

}