<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\SavePostRequest;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;
use app\Services\CategoryService;
use app\Services\PostService;
use app\Services\TagService;

class PostController extends Controller
{

    public $post;
    // Service triedy pre jednotlive modely, obsahuju business logiku modelov
    public $postService;
    public $categoryService;
    public $tagService;

    public function __construct(PostService $postService, CategoryService $categoryService, TagService $tagService)
    {
        $this->postService = $postService;
        $this->categoryService = $categoryService;
        $this->tagService = $tagService;
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    // vylistovanie vsetkych clankov defaultne zoradenych podla datumu
    public function index()
    {
        $posts = $this->postService->getAllPosts();

        return view('posts.index')
            ->with([
                'posts' => $posts,
                'title' => 'Všetky články',
                ]);
    }

    // formular pre vytvorenie noveho clanku
    public function create()
    {
        // asociativne pole vsetkych kategorii v tvare $kategoria[id_kategorie] = nazov_kategorie
        $categoriesArray = [];
        // naplnenie pola kategoriami
        $categoriesArray = $this->categoryService->getCatsArray();

        return view('posts.create')
            ->with('title', 'Nový blog')
            ->with('tags', '')
            ->with('categories', $categoriesArray);;
    }

    // samotne vytvorenie(logika) noveho clanku
    public function store(SavePostRequest $request)
    {
        $post = $this->postService->createNewPost($request);
        
        return view('posts.show')
            ->with('post', $post)
            ->with('user', $post->user);
    }

    // zobrazenie konkretneho clanku
    public function show($id)
    {
        // najde post a vyvola event 'PostViewed'
        $post = $this->postService->showPost($id);

        return view('posts.show')
            ->with('post', $post) // dany clanok
            ->with('user', $post->user);  // info o autorovi clanku, ktore je zobrazene po boku
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $this->authorize('updatePost', $post);

        // string, ktory obsahuje vsetky tagy, oddelene ciarkami
        $tagString = $this->tagService->tagsToString($post->tags->all());

        // asociativne pole vsetkych kategorii v tvare $kategoria[id_kategorie] = nazov_kategorie
        $categoriesArray = [];
        // naplnenie pola kategoriami
        $categoriesArray = $this->categoryService->getCatsArray();

        return view('posts.edit')
            ->with('title', 'Edit post')
            ->with('post', $post)
            ->with('tags', $tagString)
            ->with('categories', $categoriesArray);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SavePostRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        
        // kontrola, ci moze dany uzivatel editovat tento post
        $this->authorize('updatePost', $post);

        // metoda updatePost, v ktorej sa vykonava editacia postu
        // vracia editovany post
        $post = $this->postService->updatePost($request, $id);

        return view('posts.show')
            ->with('post', $post)
            ->with('user', $post->user);
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