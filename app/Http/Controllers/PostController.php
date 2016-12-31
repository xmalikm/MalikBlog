<?php

namespace App\Http\Controllers;

use App\Events\BlogCreated;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Image;

class PostController extends Controller
{

    public $post;

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
        // dd($request->input('tags'));
        $explodeTagsArray = [];
        $tagsDB = DB::table('tags');

        // najskor sa ulozi nadpis, text clanku a kategoria
        $this->post = Auth::user()->posts()->create($request->only(['title', 'text', 'category']));

        // nasledne sa vytvori obrazok a do db sa ulozi jeho nazov
        // ak request z formularu obsahuje subor(obrazok)
        if($request->hasFile('blog_photo')) {
            $fileName = $this->setBlogPhoto($request);
        }

        $this->post->blog_photo = $fileName;
        $this->post->save();
        
        // pole asociativnych poli, ktore obsahuju mena novych tagov
        $tagsNamesArray = $this->handleTags($request->input('tags'));
        // vlozenie novych tagov do db
        $tagsDB->insert($tagsNamesArray);

        // pole novych tagov
        $explodeTagsArray = $this->explodeTags($request->input('tags'));

        $newTags = $tagsDB->whereIn('name', $explodeTagsArray)->select('id')->get()->all();
        $tagsId = $this->getTagsId($newTags);

        $this->post->tags()->sync( $tagsId ?: [] );
        
        return "ok";
        // zvysit pocet blogov usera

    }

    // zobrazenie konkretneho clanku
    public function show($id)
    {
        $this->post = Post::findOrFail($id);

        return view('posts.show')
            ->with('post', $this->post);
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

    // vytvorenie obrazku, nahrateho userom
    // ulozenie obrazku do daneho folder-u
    // return nazvu suboru
    public function setBlogPhoto($request) {
        $blogPhoto = $request->file('blog_photo');
        $fileName = time() . '.' . $blogPhoto->getClientOriginalExtension();
        Image::make($blogPhoto)->resize(500, 300)->save( public_path('uploads/blog_photos/' . $fileName));

        return $fileName;
    }

    // ohandlovanie tagov z formularu usera
    // funkcia vytvori pre kazdy tag, nachadzajuci sa v jednom velkom stringu tagov,
    // asociativne pole, ktore obsahuje meno daneho tagu v tvare ['name' => 'meno_tagu']
    // ako navratova hodnota sa vracia pole, obsahujuce jednotlive asociativne polia
    public function handleTags($tagsArray) {
        //  pole splitnutych stringov z formularu
        $explodeTagsArray = [];
        //  jedno velke pole poli, ktore ma tvar velkePole = [['name' => 'foo'], ['name' => 'bar'], ...]
        $allTagsArray = [];

        $explodeTagsArray = $this->explodeTags($tagsArray);

        // vytvorenie velkeho pola tagov v loope
        foreach ($explodeTagsArray as $tag) {
            $allTagsArray[] = array('name' => $tag);
        }

        return ($allTagsArray);
    }

    // splitnutie jedneho velkeho stringu tagov oddelenych ciarkami na pole stringov(tagov) 
    public function explodeTags($tagsArray) {
        return explode(",", $tagsArray);
    }

    // funkcia vrati id-cko kazdeho tagu z premen. $tagsArray, ktory je ulozeny v db
    public function getTagsId($tagsArray) {
        $tagsId = [];

        foreach ($tagsArray as $tag) {
            $tagsId[] = $tag->id;
        }

        return $tagsId;
    }
}