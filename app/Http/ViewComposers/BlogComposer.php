<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use app\Services\CategoryService;

class BlogComposer
{

    public function __construct(CategoryService $categoryService)
    {
        // Dependencies automatically resolved by service container...
        $this->categoryService = $categoryService;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('categories', $this->categoryService->getAllCategories());
    }
}