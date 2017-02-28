<?php
/**
 *    controller post modelu
 */
namespace App\Http\Controllers;

use App\Events\PostViewed;
use App\Http\Requests\SavePostRequest;
use App\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use app\Services\CategoryService;
use app\Services\CommentService;
use app\Services\PostService;
use app\Services\TagService;

class PostController extends Controller
{

    public $post;
    // Service triedy pre jednotlive modely, obsahuju business logiku modelov
    public $postService;
    public $categoryService;
    public $tagService;
    public $commentService;

    public function __construct(PostService $postService, CategoryService $categoryService, TagService $tagService, CommentService $commentService) {
        $this->postService = $postService;
        $this->categoryService = $categoryService;
        $this->tagService = $tagService;
        $this->commentService = $commentService;
        // auth middleware -> zabezpeci ze na prezeranie definovanych stranok musi byt uzivatel prihlaseny
        $this->middleware('auth', ['except' => ['index', 'show', 'welcome']]);
    }

    /**
     *    vracia uvodnu stranku aplikacie
     */
    public function welcome() {
        // clanky do slideru
        $sliderPosts = Post::orderBy('created_at', 'desc')->limit(6)->get();
        // clanky podla kategorii
        $catPosts = $this->postService->getByCategory();
        // random clanky
        $randomPosts = $this->postService->getRandomPosts();
        // kategorie ktore obsahuju clanky
        $postsCategories = $this->categoryService->getCatsWithPosts();
        // najviac diskutovane clanky
        $discussedPosts = $this->postService->getMostDiscussed(5);
        // komentare uzivatelov
        $usersComments = $this->commentService->getComments();
        // tagy clankov
        $tags = $this->tagService->getAllTags();

        return view('welcome')
            ->with([
                'sliderPosts' => $sliderPosts,
                'catPosts' => $catPosts,
                'randomPosts' => $randomPosts,
                'postsCategories' => $postsCategories,
                'discussedPosts' => $discussedPosts,
                'usersComments' => $usersComments,
                'tags' => $tags,
            ]);
    }

    /**
     *    vylistovanie vsetkych clankov zoradenych podla datumu
     */
    public function index() {
        $posts = Post::orderBy('created_at', 'desc')->get();
        
        return view('posts.indexPost')
            ->with([
                'posts' => $posts,
                'title' => 'Všetky články',
            ]);
    }

    /**
     *    formular pre vytvorenie noveho clanku
     */
    public function create() {

        return view('posts.create')
            ->with([
                'title' => 'Nový blog',
            ]);
    }

    /**
     *    samotne vytvorenie(logika) noveho clanku
     */
    public function store(SavePostRequest $request) {
        // service metoda vytvori novy clanok
        $post = $this->postService->createNewPost($request);

        if($post == null)
            abort(404);

        return view('posts.show')
            ->with([
                'post' => $post,
                'user' => $post->user, // autor clanku
                'likes' => $post->likes, // uzivatelia, ktorim sa tento clanok paci
                'comments' => $post->comments, // komentare k postu
            ]);
    }

    /**
     *    zobrazenie konkretneho clanku
     */
    public function show($id, $slug = null) {
        // najde post
        $post = Post::findOrFail($id);

        // skontrolujeme ci je spravne zadana URL-ka
        // ak je slug zmeneny alebo nie je zadany vobec, redirectni znovu na 
        // tento post ale uz so spravnim slugom a id-ckom clanku
        if($post->slug !== $slug || $slug == null)
            return redirect()->route('post.show', ['id' => $post->id, 'slug' => $post->slug]);

        // event inkrementuje pocet zobrazeni postu
        event(new PostViewed($id));
        // treba aktualizovat udaje, ktore zmenil PostViewed event
        $post = Post::findOrFail($id);
        $comments = $post->comments->sortByDesc('created_at');
        return view('posts.show')
            ->with([
                'post' => $post,
                'user' => $post->user, // autor clanku
                'likes' => $post->likes, // uzivatelia, ktorim sa tento clanok paci
                'comments' => $comments, // komentare k postu
            ]);
    }
    
    /**
     *    zobrazi formular pre editaciu clanku
     */
    public function edit($id) {
        $post = Post::findOrFail($id);
        // skontroluje, ci je uzivatel opravneny clanok editovat
        $this->authorize('updatePost', $post);

        // string, ktory obsahuje vsetky tagy, oddelene ciarkami
        // zabezpeci, aby sa dali zobrazit povodne tagy clanku
        $tagString = $this->tagService->tagsToString($post->tags->all());

        return view('posts.edit')
            ->with([
                'title' => 'Edit post',
                'post' => $post,
                'tags' => $tagString,
            ]);
    }

    /**
     *    editacia clanku
     */
    public function update(SavePostRequest $request, $id) {
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
                'comments' => $post->comments, // komentare k postu
            ]);
    }

    /**
     *    vymazanie clanku - ajax volanie
     */
    public function destroy($id) {
        $this->postService->deletePost($id);

        return response()->json([
            'msg' => 'Článok bol úspešne vymazaný!'
        ], 200);
    }

    /**
     *    clanky zoradene od najnovsich
     */
    public function getNewest() {
        $posts = Post::orderBy('created_at', 'desc')->get();

        return view('posts.indexPost')
            ->with([
                'posts' => $posts,
                'title' => 'Články podľa dátumu',
            ]);
    }

    /**
     *    clanky zoradene od najcitanejsich
     */
    public function getMostViewed() {
        $posts = Post::orderBy('unique_views', 'desc')->get();
        
        return view('posts.indexPost')
            ->with([
                'posts' => $posts,
                'title' => 'Články podľa počtu zobrazení',
            ]);
    }

    /**
     *    clanky zoradene od najviac diskutovanych
     */
    public function getMostDiscussed() {
       $posts = $this->postService->getMostDiscussed();

        return view('posts.indexPost')
            ->with([
                'posts' => $posts,
                'title' => 'Najviac diskutované články',
            ]);
    }

}