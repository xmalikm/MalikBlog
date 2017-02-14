<?php

namespace app\Services;

use App\Category;
use Illuminate\Support\Facades\DB;
use app\Services\BaseService;


/**
 * Service class Category modelu
 * Obsahuje business logiku modelu
 */
class CategoryService extends BaseService{


	public function __construct() {
        //
	}

    // vytvori a vrati novu kategoriu
    public function createCategory($request) {
        // pravidla pre validovanie
        $rules = [
            'name' => 'required|unique:categories,name',
        ];

        // spravy, ktore sa vypisu ak validacia neprejde
        $messages = [
            'name.required' => 'Nezadali ste kategóriu',
            'name.unique' => 'Táto kategória už existuje',
        ];

        // samotna validacia uzivatelskeho vstupu, ktora je definovana v BaseService triede
        $this->validate($request, $rules, $messages);

        // vrati sa novovytvorena kategoria
        return Category::create($request->only('name'));
    }

	// vytvori asociativne pole [id_kategorie => nazov_kategorie]
	public function getCatsArray() {
        // vsetky kategorie clankov
        $categories = Category::all();
        // asociativne pole vsetkych kategorii
        $catsArray = [];
        // prva polozka s select tagu
        $catsArray[''] = 'Vyberte kategoriu';

        foreach ($categories as $category) {
            $catsArray[$category->id] = $category->name;
        }

        return $catsArray;
    }

    // vsetky kategorie
    public function getAllCategories() {
        return Category::all();
    }

    public function getCatsWithPosts() {
        $categories = Category::join('posts', 'categories.id', '=', 'posts.category_id')
                  ->select('categories.id', 'categories.name', DB::raw('count(posts.id) as countPosts'))
                  ->groupBy('categories.id', 'categories.name')
                  ->get();

        return $categories;
    }

}