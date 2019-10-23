<?php
/**
 * Created by PhpStorm.
 * User: jayben
 * Date: 01/07/2018
 * Time: 19:16
 */

namespace App\Repositories;


use App\Interfaces\EloquentInterface;
use App\Models\Region;
use Illuminate\Http\Request;

class RegionRepository implements EloquentInterface
{
    protected $region;

    public function __construct(Region $region)
    {
        $this->region = $region;
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAll()
    {
        return $this->region->paginate(9);
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public function getById(int $id)
    {
        return $this->region->findOrFail($id);
    }

    /**
     * @param  Request  $request
     * @throws \Exception
     */
    public function store(Request $request)
    {
        $region = new Region();

        $this->save($region, $request);
    }

    /**
     * @param  Region  $region
     * @param  Request  $request
     * @throws \Exception
     */
    private function save(Region $region, Request $request)
    {
        $region->name = $request->name;
        $region->title = $request->title;
        $region->subtitle = $request->subtitle;
        $region->description = $request->description;

        $region->save();

        if($request->has('main_photo')) {

            $region->main_photo = $this->uploadMainImage($request, $region);

            $region->save();
        }
    }

    public function update(Request $request, int $id)
    {
        $region = $this->getById($id);

        $region->name = $request->name;
        $region->title = $request->title;
        $region->subtitle = $request->subtitle;
        $region->description = $request->description;

        $region->save();

        if($request->has('main_photo')) {

            $region->main_photo = $this->uploadMainImage($request, $region);

            $region->save();
        }
    }

    /**
     * Gère l'upload le fichier image
     * @param Request $request
     * @param Region $region
     * @return mixed
     * @throws \Exception
     */
    private function uploadMainImage(Request $request, Region $region)
    {
        $path = '';

        //test si il y une image dans la requete
        if($request->file('main_photo'))
        {
            try {

                $path = $request->file('main_photo')->store('public/regions/'.$region->id);

            }catch (\Exception $exception){
                //si exception : message d'erreur
                throw new \Exception($exception->getMessage());
            }

            $array = explode('/', $path);
            return $array[1].'/'.$array[2].'/'.$array[3];
        }

        return $path;
    }
}