<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;
use app\Services\LikeService;

class LikeController extends Controller
{
    
	public $likeService;

	public function __construct(LikeService $likeService) {
		$this->likeService = $likeService;
	}

    // lajknutie konkretneho postu
	public function likePost($id) {
		// kontrola ci post existuje alebo validacia alebo nieco

		// spracovanie lajku od uzivatela
		$response = $this->likeService->handleLike('App\Post', $id);
		$post = Post::find($id);
		// v db sa uz nachadza zaznam s lajkom tohto uzivatela
		if($response == null) {
			// posli error message
			$errorMsg = "Popularitu článku si už zvýšil!";
			
			return response()->json(array('errorMsg'=> $errorMsg), 200);
		}
		// uzivatel este clanok nelajkol
		else {
			// vratime hodnoty, ktore chceme na stranke aktualizovat
			return response()->json([
				'msg'=> "Článok sa mi páči",
				// popularita clanku
				'popularity' => $post->popularity,
				// priemerna popularita autora clanku
				'avg_popularity' => $post->user->avg_popularity,
			], 200);
		}
	}

	public function likeComment($id) {
		// kontrola ci post existuje alebo validacia alebo nieco

		// spracovanie lajku od uzivatela
		$response = $this->likeService->handleLike('App\Comment', $id);

		$comment = Comment::find($id);

		// v db sa uz nachadza zaznam s lajkom tohto uzivatela
		if($response == null) {
			// posli error message
			$errorMsg = "Komentár sa ti už páči!";
			
			return response()->json(array('errorMsg'=> $errorMsg), 200);
		}
		// uzivatel este komentar nelajkol
		else {
			// vratime hodnoty, ktore chceme na stranke aktualizovat
			return response()->json([
				'msg'=> "Komentár sa mi páči",
				'numOfLikes' => count($comment->likes),
			], 200);
		}
	}

}