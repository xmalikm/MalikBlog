<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use app\Services\CategoryService;

class CategoryController extends Controller
{

    public $categoryService;

    public function __construct(CategoryService $categoryService) {
        $this->categoryService = $categoryService;
    }

    // vytvorenie novej kategorie
    public function store(Request $request)
    {
        // zvaliduje novu kategoriu a vytvori ju
        $newCategory = $this->categoryService->createCategory($request);

        // ak validacia presla, vrati sa spat
        return back()
            ->with('newCatMessage', 'Nová kategória bola pridaná!') // sprava pre uzivatela
            ->with('newCat', $newCategory->id); // vytvorenu kategoriu nastavime vo view ako vybratu
    }

    // vylistovanie clankov z danej kategorie
    public function show($id)
    {
        // najdeme kategoriu s danym id-ckom
        $category = Category::findOrFail($id);
        
        return view('categories.indexCategory')
            ->with([
                'title' => 'Články z kategórie <span class = "text-highlighter">'. $category->name ."</span>",
                'category' => $category,
            ]);
    }
    
}
