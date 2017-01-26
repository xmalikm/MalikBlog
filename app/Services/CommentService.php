<?php

namespace app\Services;

use App\Comment;
use App\Post;
use Illuminate\Support\Facades\Validator;
use app\Services\BaseService;


/**
 * Service class Category modelu
 * Obsahuje business logiku modelu
 */
class CommentService {


	public function __construct() {
        //
	}

    // vytvorenie noveho komentara
    public function createComment($request) {
        // obsah komentara
        $commentBody = $request->input('body');
        // validacia zlyhala
        if($this->validate($commentBody))
            return false;

        // ak validacia presla, mozme vytvorit komentar

        // najdeme clanok, ku ktoremu pridavame komentar
        $post = Post::find($request->input('post_id'));

        $comment = $post->comments()->create($request->all());

        return $comment;
    }

    // editacia komentara
    public function updateComment($request, $id) {
        // obsah komentara
        $commentBody = $request->input('commentBody');
        // validacia zlyhala
        if($this->validate($commentBody))
            return false;

        // ak validacia presla, mozme upravit komentar
        $comment = Comment::find($id);
        $comment->body = $commentBody;
        $comment->save();

        return $comment;
    }

    // validacia obsahu komentaru
    public function validate($commentBody) {
        // vytvorime validator, skontrolujeme ci je komentar zadany
        $validator = Validator::make(['commentBody' => $commentBody], [
            'commentBody' => 'required',
        ]);

        // ak validacia nepresla vrati true, inak vrati false
        return $validator->fails();
    }

}