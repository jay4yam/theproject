<?php
/**
 * Created by PhpStorm.
 * User: jayben
 * Date: 17/05/2018
 * Time: 20:40
 */

namespace App\Repositories;


use App\Models\Voyage;


class VoyageRepository
{
    /**
     * @var Voyage
     */
    protected $voyage;

    /**
     * VoyageRepository constructor.
     * @param Voyage $voyage
     */
    public function __construct(Voyage $voyage)
    {
        $this->voyage = $voyage;
    }

    /**
     * Renvois la liste des voyages
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function allVoyages()
    {
        return $this->voyage->with('ville', 'region')->orderBy('created_at', 'desc')->paginate(9);
    }

    /**
     * Retourne un objet voyage par son id
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public function getById($id)
    {
        return $this->voyage->findOrFail($id)->load('ville', 'region');
    }

    /**
     * Retourne la liste des voyages dans la même ville
     * @param Voyage $voyage
     * @return mixed
     */
    public function getVoyagesInRegion(Voyage $voyage)
    {
        $villeId = $voyage->ville->id;

        $otherVoyages = $this->allVoyages()->filter(function ($item) use ($villeId) {
            return $item->ville_id == $villeId;
        });

        return $otherVoyages;
    }
}