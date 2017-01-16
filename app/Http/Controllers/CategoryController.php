<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use app\Services\CategoryService;

class CategoryController extends Controller
{


    public $categoryService;
    public $postService;

    public function __construct(CategoryService $categoryService) {
        $this->categoryService = $categoryService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // zvaliduje novu kategoriu a vytvori ju
        $this->categoryService->createCategory($request);

        // ak validacia presla, vrati sa a vypise success spravu
        return back()
            ->with('newCatMessage', 'Nová kategória bola pridaná! Môžete si ju vybrať!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = $this->categoryService->findCategory($id);

        return view('categories.indexCategory')
            ->with([
                'title' => 'Články z kategórie <b>'. $category->name ."</b>",
                'category' => $category,
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
