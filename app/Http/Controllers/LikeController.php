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

		$this->likeService->handleLike('App\Post', $id);
		return redirect()->back();
	}

}