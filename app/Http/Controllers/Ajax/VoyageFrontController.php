<?php

namespace App\Http\Controllers\Ajax;

use App\Models\Voyage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Helpers\CartHelper;

class VoyageFrontController extends Controller
{
    /**
     * @var Voyage
     */
    protected $voyage;

    /**
     * VoyageFrontController constructor.
     * @param Voyage $voyage
     */
    public function __construct(Voyage $voyage)
    {
        $this->voyage = $voyage;
    }

    /**
     * Retourne un tableau qui permet de gèrer l'autocompletion de la barre de recherche dans voyage._aside
     * @return array
     */
    public function getVoyagesListForAutocomplete()
    {
        $voyages = $this->voyage->isPublic()->with('ville', 'region')->distinct('ville_id')->get(['ville_id']);

        $array = [];

        foreach ($voyages as $voyage)
        {
            //$array [] =  $voyage->ville->name.' - '.$voyage->region->first()->name;
            $array [] = [
                'label' => $voyage->ville->name.' '.$voyage->region->first()->name,
                'value' => $voyage->ville_id.'-'.$voyage->ville->name
            ];
        }

        return $array;
    }

    /**
     * Retourne les infos d'un voyage
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function getVoyagesInfoForCart(Request $request)
    {
        try {
            $voyageId = $request->id;

            $voyage = $this->voyage->findOrFail($voyageId);

        }catch (\Exception $exception){
            return response(['fail' => $exception->getMessage()]);
        }

        return response()->json(['success' => true, 'voyage' => $voyage]);
    }
}
