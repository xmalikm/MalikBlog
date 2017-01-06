<?php

namespace App\Traits;

use App\Category;

trait CategoryTrait
{
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