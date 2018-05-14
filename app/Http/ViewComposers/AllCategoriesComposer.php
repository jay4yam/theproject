<?php
/**
 * Created by PhpStorm.
 * User: jayben
 * Date: 12/05/2018
 * Time: 18:52
 */

namespace App\Http\ViewComposers;

namespace App\Http\ViewComposers;
use App\Models\Categories;
use Illuminate\View\View;

class AllCategoriesComposer
{
    protected $categories;

    public function __construct(Categories $categories)
    {
        $this->categories = $categories;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('allCats', $this->categories->pluck('title', 'id'));
    }
}