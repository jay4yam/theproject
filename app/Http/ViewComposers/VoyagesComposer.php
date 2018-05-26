<?php
/**
 * Created by PhpStorm.
 * User: jayben
 * Date: 19/05/2018
 * Time: 02:45
 */

namespace App\Http\ViewComposers;

use App\Models\Ville;
use App\Models\Voyage;
use Illuminate\View\View;

class VoyagesComposer
{
    /**
     * @var Ville
     */
    protected $ville;

    /**
     * @var
     */
    protected $voyage;

    /**
     * VoyagesComposer constructor.
     * @param Ville $ville
     * @param Voyage $voyage
     */
    public function __construct(Ville $ville, Voyage $voyage)
    {
        $this->ville = $ville;
        $this->voyage = $voyage;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getMinPrice()
    {
        $item = $this->voyage->where('discount_price', '!=', 0)->orderBy('price', 'asc')->first();

        return $item->discount_price;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getMaxPrice()
    {
        $item =  $this->voyage->orderBy('price', 'desc')->first();

        return $item->price;
    }

    /**
     * Retourne la liste des villes en cache
     * @return mixed
     */
    public function getVilles()
    {
        //init. un tableau
        $array = [];

        $value = \Cache::remember('ville_count_voyage', 10, function () use(&$array){
            //itère sur les voyages public groupés par ville
            $this->voyage->isPublic()->with('ville')->get(['id', 'ville_id'])->groupBy('ville_id')->each(function ($items) use (&$array) {
                    foreach ($items as $item) {
                        $array [$item->ville->name] = ['id' => $item->ville_id, 'count' => $items->count()];
                    }
                });
            return $array;
        });

        return $value;
    }

    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->with([
            'villes' => $this->getVilles(),
            'minPrice' => $this->getMinPrice(),
            'maxPrice' => $this->getMaxPrice()
            ]);
    }
}