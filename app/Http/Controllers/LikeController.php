<?php

namespace App\Http\Controllers;

use App\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

		$response = $this->likeService->handleLike('App\Post', $id);
		$post = \App\Post::find($id);
		if($response == null) {
			$msg = "Popularitu článku si už zvýšil!";
			return response()->json(array('msg'=> $msg), 200);
		}
		else {
			$msg = "Článok sa mi páči";
			$popularity = $post->popularity;
			$avg_popularity = $post->user->avg_popularity;
			return response()->json(['msg'=> $msg, 'popularity' => $popularity, 'avg_popularity' => $avg_popularity], 200);
		}

		
	}

}