<?php
/**
 *    controller comment modelu
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Services\CommentService;

class CommentController extends Controller
{

    public $commentService;

    public function __construct(CommentService $commentService) {
        $this->commentService = $commentService;
    }

    /**
     *    vytvorenie noveho komentara
     */
    public function store(Request $request)
    {
        // metoda z comment service zvaliduje a vytvori novy komentar
        $comment = $this->commentService->createComment($request);
        // nastala nejaka chyba, vytvorenie komentaru neprebehlo
        if(!$comment) {
            return response()->json([
                'errorMsg' => 'Chyba: nezadal si komentar',
            ], 200);
        }
        // vytvorenie komentaru prebehlo uspesne
        else {
            // autor komentaru
            $user = $comment->user;
            // autor clanku
            $postAuthor = $comment->post->user;

            // vratime vsetky hodnoty, ktore chceme na stranke aktualizovat
            return response()->json([
                'msg' => 'Novy komentar pridany',
                'comment' => $comment,
                // novy priemerny pocet komentarov autora clanku
                'avg_comments' => $postAuthor->avg_comments,
                'user' => $user,
                // profilova fotka uzivatela
                'profile_photo' => asset('uploads/profile_photos/'. $user->profile_photo),
                // novy pocet komentarov clanku
                'numOfComments' => count($comment->post->comments),
            ], 200);
        }

        
    }

    /**
     *    editacia komentara
     */
    public function update(Request $request, $id)
    {
        // nastala nejaka chyba, editacia zlyhala
        if(!$this->commentService->updateComment($request, $id)) {
            return response()->json([
                'errorMsg' => 'Chyba: nezadal si komentar',
            ], 200);
        }
        // editacia uspesne prebehla
        else {
            return response()->json([
                'msg' => 'Editacia prebehla uspesne',
            ], 200);
        }

    }

}
