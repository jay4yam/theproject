<?php
/**
 * Created by PhpStorm.
 * User: jayben
 * Date: 03/06/2018
 * Time: 18:02
 */

namespace App\Repositories;


use App\Models\Ville;
use App\Interfaces\EloquentInterface;
use App\Traits\VoyageImageUpload;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class VilleRepository implements EloquentInterface
{
    use VoyageImageUpload;

    /**
     * @var Ville
     */
    protected $ville;

    /**
     * VilleRepository constructor.
     * @param Ville $ville
     */
    public function __construct(Ville $ville)
    {
        $this->ville = $ville;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getById(int $id)
    {
        return $this->ville->findOrFail($id);
    }

    /**
     * Retourne la liste des villes paginées
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAll()
    {
        return $this->ville->paginate(9);
    }

    public function store(Request $request)
    {
        $ville = new Ville();

        $this->save($ville, $request);
    }

    private function save(Ville $ville, Request $request)
    {
        $ville->name = $request->name;
        $ville->title = $request->title;
        $ville->subtitle = $request->subtitle;
        $ville->description = $request->description;

        if($request->has('main_photo')){
            $ville->main_photo = $this->uploadImage($request, $ville);
        }

        $ville->region_id = $request->region_id;

        $ville->save();
    }

    /**
     * @param  Request  $request
     * @param $id
     * @throws \Exception
     */
    public function update(Request $request, int $id)
    {
        $ville = $this->getById($id);

        $ville->name = $request->name;
        $ville->title = $request->title;
        $ville->subtitle = $request->subtitle;
        $ville->description = $request->description;

        if($request->has('main_photo')){
            $ville->main_photo = $this->uploadImage($request, $ville);
        }

        $ville->region_id = $request->region_id;

        $ville->save();
    }
}