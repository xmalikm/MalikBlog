<?php

namespace app\Services;

use App\Category;
use Validator;
use app\Services\BaseService;


/**
 * Service class Post modelu
 * Obsahuje celu business logiku modelu
 */
class CategoryService extends BaseService{

    protected $errors;

	public function __construct() {
        //
	}

    public function findCategory($id) {
        return Category::findOrFail($id);
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

        return Category::create($request->only('name'));
    }

	// vytvori asociativne pole [id_kategorie => nazov_kategorie]
	public function getCatsArray() {
        // vsetky kategorie clankov
        $categories = Category::all();
        // asociativne pole vsetkych kategorii
        $catsArray = [];
        $catsArray[0] = 'Vyberte kategoriu';
        foreach ($categories as $category) {
            $catsArray[$category->id] = $category->name;
        }

        return $catsArray;
    }

    // vsetky kategorie
    public function getAllCategories() {
        return Category::all();
    }

}