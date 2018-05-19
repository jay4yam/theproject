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
     * VilleListComposer constructor.
     * @param Ville $ville
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
        $villes = \Cache::remember('villes', 10, function (){
            return $this->ville->pluck('name', 'id');
        });

        return $villes;
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