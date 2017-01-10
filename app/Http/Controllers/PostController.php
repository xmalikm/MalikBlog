<?php

namespace App\Http\Controllers;

use App\Category;
use App\Events\PostViewed;
use App\Http\Requests\SavePostRequest;
use App\Post;
use App\Tag;
use App\Traits\CategoryTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;

class PostController extends Controller
{
    use CategoryTrait;

    public $post;

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

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
        // asociativne pole vsetkych kategorii v tvare $kategoria[id_kategorie] = nazov_kategorie
        $categoriesArray = [];
        // naplnenie pola kategoriami
        $categoriesArray = $this->getCatsArray();


        return view('posts.create')
            ->with('title', 'Nový blog')
            ->with('tags', '')
            ->with('categories', $categoriesArray);;
    }

    // samotne vytvorenie(logika) noveho clanku
    public function store(SavePostRequest $request)
    {
        // dd($request->all());
        $splitTagsArray = [];
        $user = Auth::user();
        // najskor sa ulozi nadpis, text clanku a kategoria
        $this->post = $user->posts()->create($request->only(['title', 'text','category_id']));
        // nasledne sa vytvori obrazok a do db sa ulozi jeho nazov
        // ak request z formularu obsahuje subor(obrazok)
        if($request->hasFile('blog_photo')) {
            $fileName = $this->setBlogPhoto($request->file('blog_photo'));
            // nazov obrazku je ulozeny fo db
            $this->post->blog_photo = $fileName;
            $this->post->save();
        }
        // pole tagov
        $splitTagsArray = $this->explodeTags($request->input('tags'));
        // vytvorenie tagov
        $tagIds = $this->createTags($splitTagsArray);
        // synchronizacia tagov s modelom
        $this->post->tags()->sync( $tagIds ?: [] );
        // zvysit pocet blogov usera
        $this->incrNumOfBlogs();

        return view('posts.show')
            ->with('post', $this->post)
            ->with('user', $user);
    }

    // zobrazenie konkretneho clanku
    public function show($id)
    {
        $this->post = Post::findOrFail($id);
        $user = $this->post->user;
        event(new PostViewed($this->post->id));

        return view('posts.show')
            ->with('post', $this->post) // dany clanok
            ->with('user', $user);  // info o autorovi clanku, ktore je zobrazene po boku
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->post = Post::findOrFail($id);
        $this->authorize('updatePost', $this->post);
        // string, ktory obsahuje vsetky tagy, oddelene ciarkami
        $tagString = $this->tagsToString($this->post->tags->all());

        // asociativne pole vsetkych kategorii v tvare $kategoria[id_kategorie] = nazov_kategorie
        $categoriesArray = [];
        // naplnenie pola kategoriami
        $categoriesArray = $this->getCatsArray();

        return view('posts.edit')
            ->with('title', 'Edit post')
            ->with('post', $this->post)
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
        $this->post = Post::findOrFail($id);
        $user = $this->post->user;
        $this->authorize('updatePost', $this->post);
        $this->post->update($request->only(['title', 'text', 'category_id']));
        if($request->hasFile('blog_photo')) {
            $fileName = $this->setBlogPhoto($request->file('blog_photo'));
            // nazov obrazku je ulozeny fo db
            $this->post->blog_photo = $fileName;
            $this->post->save();
        }

        $splitTagsArray = [];
        // pole tagov
        $splitTagsArray = $this->explodeTags($request->input('tags'));
        // vytvorenie tagov
        $tagIds = $this->createTags($splitTagsArray);
        // synchronizacia tagov s modelom
        $this->post->tags()->sync( $tagIds ?: [] );

        return view('posts.show')
            ->with('post', $this->post)
            ->with('user', $user);
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

    // vytvorenie obrazku, nahrateho userom
    // ulozenie obrazku do daneho folder-u
    // return nazvu suboru
    public function setBlogPhoto($blogPhoto) {
        $fileName = time() . '.' . $blogPhoto->getClientOriginalExtension();
        Image::make($blogPhoto)->resize(500, 300)->save( public_path('uploads/blog_photos/' . $fileName));

        return $fileName;
    }

    // splitnutie jedneho velkeho stringu tagov oddelenych ciarkami na pole stringov(tagov) 
    public function explodeTags($tagsArray) {
        return explode(",", $tagsArray);
    }

    // zvysi sa pocet clankov prihlaseneho usera
    public function incrNumOfBlogs() {
        $user = Auth::user();
        $user->num_of_articles++;
        $user->save();
    }

    // vytvorenie jednotlivych tagov
    // navratova hodnota je pole id novych tagov
    public function createTags($tagsArray) {
        $tagIds = [];

        foreach ($tagsArray as $tag) {
            if( !$newTag = Tag::firstOrCreate(['name' => $tag]) )
                throw new Exception("Nieco je zle");

            $tagIds[] = $newTag->id;
        }

        return $tagIds;
    }

    // funkcia vytvori jeden velky string tagov
    public function tagsToString($tagsArray) {
        $string = '';
        // pocet tagov
        $len = sizeof($tagsArray);
        // iterator
        $i = 0;

        foreach ($tagsArray as $tag) {
            $string .= $tag->name . (++$i>=$len ? '' : ',');
        }

        return $string;
    }


}