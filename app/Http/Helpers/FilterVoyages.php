<?php


namespace App\Http\Helpers;


use App\Models\Voyage;
use Illuminate\Http\Request;

class FilterVoyages
{
    protected $voyage;

    public function __construct(Voyage $voyage)
    {
        $this->voyage = $voyage;
    }

    /**
     * Retourne la liste des voyages filtrés par ville
     * @param Request $request
     * @return mixed
     */
    public function getVoyagesByCities(Request $request)
    {
        $ville = $request->ville;

        $voyages = $this->voyage->localize()->isPublic()->with('ville', 'region')->whereIn('ville_id', $ville)->paginate(9);

        return $voyages;
    }

    /**
     * Renvois la liste des voyages classés par prix
     * @param Request $request
     * @return mixed
     */
    public function getVoyagesByPrice(Request $request)
    {

        //1. si les deux request 'price min' et 'price max' sont passés dans le form
        if(isset($request->price_min) && isset($request->price_max)){
            $priceArray = [ $request->price_min, $request->price_max ];
            return $this->voyage->localize()->isPublic()->with('ville', 'region')->whereBetween('price', $priceArray)->paginate(9);
        }

        //2. si 'price min' est passé dans le form
        if(isset($request->price_min) && !isset($request->price_max)){
            return $this->voyage->localize()->isPublic()->with('ville', 'region')->where('price', '>', $request->price_min)->paginate(9);
        }

    }

    /**
     * Retourne la liste des voyages d'une ville
     * @param $id
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getVoyagesForACity($id){

        $voyages = $this->voyage->localize()->isPublic()->with('ville', 'region')->where('ville_id', '=', $id)->paginate(9);

        return $voyages;
    }
}