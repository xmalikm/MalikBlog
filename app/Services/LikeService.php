<?php

namespace app\Services;

use App\Events\PostLiked;
use App\Like;
use Illuminate\Support\Facades\Auth;
use Validator;
use app\Services\PostService;


/**
 * Service class Post modelu
 * Obsahuje celu business logiku modelu
 */
class LikeService {

    protected $errors;
    public $postService;

	public function __construct(PostService $postService) {
        $this->postService = $postService;
	}

    // spracovanie lajku daneho uzivatela
    public function handleLike($type, $id) {
        // najskor skontrolujeme, ci uz uzivatel lajkoval clanok
        $existing_like = Like::where('likeable_type', $type)->where('likeable_id', $id)->where('user_id', Auth::id())->first();

        // ak neexistuje zaznam pre tento post v likeable tabulke, vytvorime novy
        if(is_null($existing_like)) {
            Like::create([
                'user_id' => Auth::id(),
                'likeable_id' => $id,
                'likeable_type' => $type,
            ]);

            if($type === 'App\Post')
                event(new PostLiked($id));
        }
    }

}