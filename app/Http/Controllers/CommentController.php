<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // \Illuminate\Support\Facades\Log::debug($request);
        $this->validate($request, ['body' => 'required']);

        $post = \App\Post::find($request->input('post_id'));

        $comment = $post->comments()->create($request->all());

        $user = $comment->user;

        return response()->json([
            'msg' => 'Novy komentar pridany',
            'user' => $user->name,
            'userPhoto' => asset('uploads/profile_photos/'. $user->profile_photo),
            'comment' => $comment->body,
            'numOfComments' => count($post->comments),
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // \Illuminate\Support\Facades\Log::debug($request->input('commentBody'));
        // telo komentara
        $commentBody = $request->input('commentBody');
        // vytvorime validator, skontrolujeme ci je komentar zadany
        $validator = \Illuminate\Support\Facades\Validator::make(['commentBody' => $commentBody], [
            'commentBody' => 'required',
        ]);

        // ak validacia nepresla, vratime vhodnu odpoved
        if ($validator->fails()) {
            return response()->json([
                'errorMsg' => 'Chyba: nezadala si komentar',
            ], 200);
        }

        // ak validacia presla, mozme upravit komentar
        $comment = \App\Comment::find($id);
        $comment->body = $commentBody;
        $comment->save();

        return response()->json([
            'msg' => 'Editacia prebehla uspesne',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
