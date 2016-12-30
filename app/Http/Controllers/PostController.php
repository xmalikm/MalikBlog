<?php

namespace App\Http\Controllers;

use App\Events\BlogCreated;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Image;

class PostController extends Controller
{
    // vylistovanie vsetkych clankov defaultne zoradenych podla datumu
    public function index()
    {
        
        $posts = Post::all();
        return view('posts.index')
            ->with([
                'posts' => $posts,
                'title' => 'Všetky články',
                ]);
    }

    // formular pre vytvorenie noveho clanku
    public function create()
    {
        return view('posts.create')
            ->with('title', 'Nový blog');
    }

    // samotne vytvorenie(logika) noveho clanku
    public function store(Request $request)
    {
        $post = Auth::user()->posts()->create($request->only(['title', 'text', 'category']));
        // event(new BlogCreated($post, $request));

        if($request->hasFile('blog_photo')) {
            $blog_foto = $request->file('blog_photo');
            $file_name = time() . '.' . $blog_foto->getClientOriginalExtension();
            Image::make($blog_foto)->resize(500, 300)->save( public_path('uploads/blog_photos/' . $file_name));
            $post->blog_photo = $file_name;
            $post->save();
        }
        
        // zvysit pocet blogov usera

    }

    // zobrazenie konkretneho clanku
    public function show($id)
    {
        $post = Post::findOrFail($id);

        return view('posts.show')
            ->with('post', $post);
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
        //
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
