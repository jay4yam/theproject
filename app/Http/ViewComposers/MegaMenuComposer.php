<?php
/**
 * Created by PhpStorm.
 * User: jayben
 * Date: 02/02/2019
 * Time: 22:10
 */

namespace App\Http\ViewComposers;
use App\Models\Region;
use App\Models\Ville;
use App\Models\Voyage;
use Illuminate\Support\Facades\App;
use Illuminate\View\View;

class MegaMenuComposer
{
    protected $region;
    protected $voyage;

    public function __construct(Region $region, Voyage $voyage)
    {
        $this->region = $region;
        $this->voyage = $voyage;
    }

    /**
     * Retourne le tableau qui affiche le menu dans le megaMenu du front
     * @return mixed
     */
    private function getMenuItems()
    {
        //Mise en cache du menu
        $value = \Cache::remember('menuItems-'.App::getLocale(), '1440', function (){
            //1. recupère toutes les régions avec les villes et les voyages
            $regions = $this->region->with('villes','voyages')->orderBy('id', 'asc')->limit(2)->get(['id', 'name']);

            //2. init un tableau
            $objet = array();

            //3. parcours la liste des regions
            foreach ($regions as $region) {

                //4. test si la region a des villes // si la relation n'est pas vide
                if($region->villes->count() != 0) {

                    //5. init les indices du tableau avec le nom de ville
                    $objet[$region->name] = array();

                    //6. itère sur le tableau des villes
                    foreach ($region->villes as $ville) {

                        //7. test si les viles ont des voyages // si la relation n'est pas vide
                        if ($ville->voyages->count() != 0) {

                            //8. init l'indice de la deuxieme dimension du tableau avec les noms de villes
                            $objet[$region->name][$ville->name] = array();

                            //9. itère sur le tableau des voyages
                            foreach ($ville->voyages as $voyage) {

                                //10. si le voyages n'est pas vide
                                if ($voyage->is_public) {
                                    //11. enregistre les voyages pour la langue de l'utilisteur
                                    if($voyage->locale == App::getLocale()) {
                                        //12. enregistre le titre et l'id du voyage à l'indice du tableau
                                        $objet[$region->name][$ville->name][] = ['id' => $voyage->id, 'title' => $voyage->title];
                                    }
                                }
                            }
                        }
                    }
                }
            }

            return $objet;
        });

        return $value;
    }

    /**
     * Retourne les 2 voyages mis en avant dans le menu
     * @return mixed
     */
    private function decorativeMegaMenu()
    {
        $value = \Cache::remember('menuDecorativesItems'.App::getLocale(), '1440', function () {
            $array = array();

            $array[] = $this->voyage->with('ville', 'region')->findOrFail(1);
            $array[] = $this->voyage->with('ville', 'region')->findOrFail(2);

            return $array;
        });

        return $value;
    }

    /**
     * Retourne un tableau de ville avec le nom comme clé, et l'id comme valeur
     * @return mixed
     */
    private function getVilleArray()
    {
        //1. crée un cache pour ce tableau de ville, pas la peine de refaire la requête tous les jours
        $arrayVille = \Cache::remember('getArrayVille', '360', function (){
            //2. init. un tableau
            $array = array();

            //3. itère sur la liste des villes
            Ville::all(['id', 'name'])->each(function ($item) use(&$array){
                //4. rempli le tableau au format villeName => id
                $array[$item->name] = $item->id;
            });

            //5. retourne le tableau
            return $array;
        });

        return $arrayVille;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with(['items' => self::getMenuItems(), 'decoratives' => self::decorativeMegaMenu(), 'arrayVille' => self::getVilleArray()]);
    }
}