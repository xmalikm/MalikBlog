<?php
/**
 * Service class Like modelu
 * Obsahuje business logiku modelu
 */
namespace app\Services;

use App\Events\PostLiked;
use App\Like;
use Illuminate\Support\Facades\Auth;

class LikeService {


	public function __construct() {
        //
	}

    /**
     *    spracovanie lajku daneho uzivatela
     */
    public function handleLike($type, $id) {
        // najskor skontrolujeme, ci uz uzivatel lajkoval bud clanok alebo
        // komentar, podla toho, co lajkuje
        $existing_like = Like::where('likeable_type', $type)->where('likeable_id', $id)->where('user_id', Auth::id())->first();

        // ak neexistuje zaznam pre tento post alebo komentar v likeable tabulke, vytvorime novy
        if(is_null($existing_like)) {
            Like::create([
                'user_id' => Auth::id(),
                'likeable_id' => $id,
                'likeable_type' => $type,
            ]);

            // ak lajkujeme post
            if($type === 'App\Post')
                // event, ktory zvysi popularitu clanku
                event(new PostLiked($id));

            // ak sa vytvoril novy lajk vrat true
            return true;
        }
        else
            // ak uz lajk od uzivatela existuje, vrat null
            return null;
    }

}