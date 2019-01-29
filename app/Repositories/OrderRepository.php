<?php
/**
 * Created by PhpStorm.
 * User: jayben
 * Date: 27/01/2019
 * Time: 20:47
 */

namespace App\Repositories;


use App\Models\ItemOrder;
use App\Models\MainOrder;
use App\Models\Voyage;

class OrderRepository
{
    protected $mainOrder;

    public function __construct(MainOrder $mainOrder)
    {
        $this->mainOrder = $mainOrder;
    }

    /**
     * Renvoie la liste des dernieres commandes
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAll()
    {
        return $this->mainOrder->with('user','itemsOrder')->orderBy('id', 'desc')->paginate(10);
    }

    /**
     * Récupère le MainOrder en fonction de son Id.
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public function getById($id)
    {
        return $this->mainOrder->with('itemsOrder')->findOrFail($id);
    }

    /**
     * Retourne les itemsOrder appartenant à un mainOrder
     * @param MainOrder $mainOrder
     * @return mixed
     */
    public function getItemsOrder(MainOrder $mainOrder)
    {
        try{
            //1. set un tableau vide
            $array = array();

            //2. itère sur le mainOrder
            foreach ($mainOrder->itemsOrder as $item)
            {
                //Récupère l'id du voyage présent dans le itemOrder
                $voyage_id = $item->voyage_id;
                //Récupère le voyage
                $voyage = Voyage::findOrFail($voyage_id);
                // insère l'image du voyage dans l'item
                $item->image = $voyage->main_photo;
                //enregistre l'item voyagge dans le tableau
                $array[] = $item;
            }

        }catch (\Exception $exception){
            //Catch en cas d'erreur
            return $exception->getMessage();
        }
        //retourne le tableau
        return $array;
    }
}