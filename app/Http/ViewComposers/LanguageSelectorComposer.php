<?php
/**
 * Created by PhpStorm.
 * User: jayben
 * Date: 31/01/2019
 * Time: 18:03
 */

namespace App\Http\ViewComposers;

use App\Models\Categories;
use Illuminate\View\View;

class LanguageSelectorComposer
{
    private $allLangues;
    private $currentRoute;

    public function __construct()
    {
        $this->allLangues = $this->getAllLanguesExceptCurrent();
        $this->currentRoute = $this->getCurrentRoute();
    }

    private function getAllLanguesExceptCurrent()
    {
        $array = \Config::get('language');

        unset($array[\App::getLocale()]);

        return $array;
    }

    private function getCurrentRoute()
    {
        //recupère l'url en cours
        $url = request()->path();

        //transforme l'url en tableau
        $urlWithoutLocale = ltrim($url, \App::getLocale().'/');

        //retourne l'url
        return $urlWithoutLocale;
    }


    public function compose(View $view)
    {
        $view->with(['allLangues' => $this->allLangues, 'currentRoute' => $this->currentRoute]);
    }
}