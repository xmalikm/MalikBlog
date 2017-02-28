<?php
/**
 * Base Service class, od ktorej dedia dalsie service triedy
 * 
 */
namespace app\Services;

use App\Post;
use App\User;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Image;

class BaseService {

    use ValidatesRequests;

	public function __construct() {
		//
	}

    /**
     *    vytvorenie obrazku, nahrateho userom
     *    ulozenie obrazku do daneho folder-u
     *    return nazvu suboru
     */
    public function setPhoto($photo, $model) {
        // nazov suboru bude unikatny -> aktualny cas
        $fileName = time() . '.' . $photo->getClientOriginalExtension();
        // ak je dany model instanciou Post modelu
        if($model instanceof Post)
            // uloz obrazok do adresara pre clanky
        	Image::make($photo)->resize(650, 350)->save('uploads/blog_photos/' . $fileName);
        // ak je dany model instanciou User modelu
        else if($model instanceof User)
            // uloz obrazok do adresara pre uzivatelov
        	Image::make($photo)->resize(650, 350)->save('uploads/profile_photos/' . $fileName);
        else
        	return null;

        return $fileName;
    }

    /**
     *    vymazanie nahrateho suboru(obrazku postu alebo profilovej fotky uzivatela)
     */
    public function deletePhoto($model) {

        // najskor ulozime cestu k suboru podla typu modelu
        // ak je dany model instanciou Post modelu
        if($model instanceof Post) {
            // ak ma clanok defaultny obrazok tak ho nevymazeme
            if($model->blog_photo === 'default.png')
                return;
            // fotky clankov maju cestu 'uploads/blog_photos/dana_fotka'
            $file_path = "uploads/blog_photos/".$model->blog_photo;
        }
        // ak je dany model instanciou User modelu
        else if($model instanceof User) {
            // ak ma uzivatel defaultnu fotku tak ju nevymazeme
            if($model->profile_photo === 'default.png')
                return;
            // fotky uzivatelov maju cestu 'uploads/profile_photos/dana_fotka'
            $file_path = "uploads/profile_photos/".$model->profile_photo;
        }
        else
            return null; // mohla by byt hodena exception

        File::delete($file_path); 
    }

}