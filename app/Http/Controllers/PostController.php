<?php

namespace App\Http\Controllers;

use App\Http\Requests\SavePostRequest;
use App\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        
        return view('posts.indexPost')
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
            ->with([
                'title' => 'Nový blog',
                'tags' => '',
                'catsArray' => $categoriesArray,
            ]);
    }

    // samotne vytvorenie(logika) noveho clanku
    public function store(SavePostRequest $request)
    {
        $post = $this->postService->createNewPost($request);
        $likes = $post->likes;
        return view('posts.show')
            ->with([
                'post' => $post,
                'user' => $post->user,
                'likes' => $likes, // uzivatelia, ktorim sa tento clanok paci
            ]);
    }

    // zobrazenie konkretneho clanku
    public function show($id)
    {
        // najde post a vyvola event 'PostViewed'
        $post = $this->postService->showPost($id);
        $postsFromAuthor = $post->user->posts->where('id', '!=', $post->id);
        $postsFromCat = $post->category->posts->where('id', '!=', $post->id);
        $recentPosts = $this->postService->getRecentPosts();
        return view('posts.show')
            ->with([
                'post' => $post, // dany clanok
                'user' => $post->user,// info o autorovi clanku, ktore je zobrazene po boku
                'likes' => $post->likes, // uzivatelia, ktorim sa tento clanok paci
                'comments' => $post->comments,
                'postsFromAuthor' => $postsFromAuthor,
                'postsFromCat' => $postsFromCat,
                'recentPosts' => $recentPosts,
            ]);
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
            ->with([
                'title' => 'Edit post',
                'post' => $post,
                'tags' => $tagString,
                'catsArray' => $categoriesArray,
            ]);
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
        $likes = $post->likes;

        return view('posts.show')
            ->with([
                'post' => $post,
                'user' => $post->user,
                'likes' => $likes, // uzivatelia, ktorim sa tento clanok paci
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $this->postService->deletePost($id);
        return response()->json([
            'msg' => 'Článok bol úspešne vymazaný!'
        ], 200);
    }

    public function getNewest() {
        $posts = Post::orderBy('created_at', 'desc')->get();

        return view('posts.indexPost')
            ->with([
                'posts' => $posts,
                'title' => 'Články podľa dátumu',
            ]);
    }

    public function getMostViewed() {
        $posts = Post::orderBy('unique_views', 'desc')->get();

        return view('posts.indexPost')
            ->with([
                'posts' => $posts,
                'title' => 'Články podľa počtu zobrazení',
            ]);
    }

}