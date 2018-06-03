<?php

namespace App\Http\Controllers\Ajax;

use App\Models\Voyage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
}
