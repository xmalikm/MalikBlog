<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Traits\CategoryTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class CategoryController extends Controller
{

    use CategoryTrait;

    // public function createSession() {
    //     Session::put('postSession', $_POST['session']);
    //     \Illuminate\Support\Facades\Log::debug('je to: '. Session::get('postSession'));
    //     return response()->json(null, 200);
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        return view('categories.indexCategory')
            ->with('categories', $categories)
            ->with('title', 'Kategórie');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Session::flash('previousUrl',URL::previous());

        if(isset($_GET['post'])) {
            Session::flash('postSession', $_GET['post']);
        }

        return view('categories.createCategory')
            ->with('title', 'Nova kategoria');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // ak sme vytvorili novu kategoriu pri editacii clanku,
        // potrebujeme mat ulozeny tento clanok
        if(Session::has('postSession')) {
            $id = Session::get('postSession');
            // treba osetrit na find or fail
            $post = Post::find($id);
            // Session::forget('postSession');
        }
        
        Category::create($request->all());
        $categories = $this->getCatsArray();

        if(isset($post)) {
            // tento redirect spravit cez session !!!!!!!!!!!!!!!
            return redirect(Session::get('previousUrl'))
                ->with('newCatMessage', 'Nová kategória bola pridaná!')
                ->with('post', $post)
                ->with('categories', $categories);
        }
        else {
            return redirect(Session::get('previousUrl'))
                ->with('newCatMessage', 'Nová kategória bola pridaná!')
                ->with('categories', $categories);
        }
            
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
