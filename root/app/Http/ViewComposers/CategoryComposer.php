<?php
/**
 * Metody suvisiace so zobrazovanim kategorii clankov, ktore sa volaju z ComposerServiceProvider-u
 * Kazda metoda naplni premenne, ktore su zdielane viacerymi views, ktore zobrazuju info o kategoriach
 */
namespace App\Http\ViewComposers;

use Illuminate\View\View;
use app\Services\CategoryService;

class CategoryComposer
{

    public $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     *    vsetky kategorie clankov
     */
    public function getCategories(View $view)
    {
        $view->with('categories', $this->categoryService->getAllCategories());
    }


    /**
     *    asociativne pole vsetkych kategorii v tvare $kategoria[id_kategorie] = nazov_kategorie
     */
    public function getCatsArray(View $view) {
        $categoriesArray = [];
        // naplnenie pola kategoriami, z ktorych si uzivatel moze vybrat vo formulari pri editacii
        $categoriesArray = $this->categoryService->getCatsArray();

        $view->with('catsArray', $categoriesArray);
    }

}