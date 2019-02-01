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

    /**
     * Retourne toutes les langues disponibles sauf celle en cours d'utilisation
     * @return mixed
     */
    private function getAllLanguesExceptCurrent()
    {
        //1. set un tableau qui contient toutes les langues du fichier config language
        $array = \Config::get('language');

        //2. supprime la langue en cours d'utilisation par l'utilisateur
        unset($array[\App::getLocale()]);

        //3. Retourne le tableau
        return $array;
    }

    /**
     * Retourne l'urk en cours sans le repertoire dédiée à la langue
     * @return string
     */
    private function getCurrentRoute()
    {
        //1. recupère l'url en cours
        $url = request()->path();

        //2. transforme l'url en tableau
        $urlWithoutLocale = ltrim($url, \App::getLocale().'/');

        //3. retourne l'url
        return $urlWithoutLocale;
    }


    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->with(['allLangues' => $this->allLangues, 'currentRoute' => $this->currentRoute]);
    }
}