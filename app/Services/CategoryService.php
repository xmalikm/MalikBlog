<?php

namespace app\Services;

use App\Category;


/**
 * Service class Post modelu
 * Obsahuje celu business logiku modelu
 */
class CategoryService {

	// repozitar modelu

	public function __construct() {
        //
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

}