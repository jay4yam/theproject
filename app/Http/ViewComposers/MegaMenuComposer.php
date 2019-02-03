<?php
/**
 * Created by PhpStorm.
 * User: jayben
 * Date: 02/02/2019
 * Time: 22:10
 */

namespace App\Http\ViewComposers;
use App\Models\Region;
use App\Models\Voyage;
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
        $value = \Cache::remember('menuItems', '1440', function (){
            //1. recupère toutes les régions avec les villes et les voyages
            $regions = $this->region->with('villes','voyages')->orderBy('id', 'asc')->limit(2)->get(['id', 'name']);

            //2. init un tableau
            $objet = array();

            //3. parcours la liste des regions
            foreach ($regions as $region) {

                //4. test si la region a des villes // si la relation n'est pas vide
                if($region->villes->count() != 0) {

                    //5. init les indices du tableau via le nom de ville
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

                                    //11. enregistre le titre et l'id du voyage à l'indice du tableau
                                    $objet[$region->name][$ville->name][] = ['id' => $voyage->id, 'title' => $voyage->title];
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
        $value = \Cache::remember('menuDecorativesItems', '1440', function () {
            $array = array();

            $array[] = $this->voyage->with('ville', 'region')->findOrFail(1);
            $array[] = $this->voyage->with('ville', 'region')->findOrFail(2);

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
        $view->with(['items' => self::getMenuItems(), 'decoratives' => self::decorativeMegaMenu()]);
    }
}