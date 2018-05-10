<?php
/**
 * Created by PhpStorm.
 * User: jayben
 * Date: 10/05/2018
 * Time: 17:18
 */

namespace App\Http\ViewComposers;

use App\Models\Categories;
use Illuminate\View\View;

class BlogCategoriesListingComposer
{

    /**
     * @var Categories
     */
    protected $categorie;

    /**
     * BlogCategoriesListingComposer constructor.
     * @param Categories $categories
     */
    public function __construct(Categories $categories)
    {
        $this->categorie = $categories;
    }

    /**
     * Retourne la liste des noms de chaque categorie
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    private function getCategoriesNameAndCount()
    {
        //Utilisation de la methode cache de laravel pour recuperer les catégories et le nombre d'arcticles liés
        $value = \Cache::remember('catNameAndCount', 100, function () {

            //recup les infos du model et le nombre d'articles liés via la function withCount
            $catCount = $this->categorie->withCount('blogs')->get();

            //init. un tableau
            $array = [];

            //itère sur la liste pour peupler le tableau
            foreach ($catCount as $item)
            {
                $array [] = [ 'id' => $item->id, 'title' => $item->title, 'count' => $item->blogs_count ];
            }

            return $array;
        });

        return $value;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('categoriesName', $this->getCategoriesNameAndCount());
    }
}