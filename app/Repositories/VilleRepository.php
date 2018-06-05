<?php
/**
 * Created by PhpStorm.
 * User: jayben
 * Date: 03/06/2018
 * Time: 18:02
 */

namespace App\Repositories;


use App\Models\Ville;
use Illuminate\Http\Request;

class VilleRepository
{
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
     * Retourne la ville via son id
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public function getById($id)
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

    /**
     * Met à jour une ville
     * @param Request $request
     * @param $id
     */
    public function update(Request $request, $id)
    {
        $ville = $this->getById($id);

        $ville->name = $request->name;
        $ville->title = $request->title;
        $ville->subtitle = $request->subtitle;
        $ville->description = $request->description;

        if($request->has('main_photo')){
            $ville->main_photo = $this->uploadMainImage($request, $ville);
        }

        $ville->save();
    }

    /**
     * Gère l'upload le fichier image
     * @param Request $request
     * @param Blog $article
     * @return mixed
     * @throws \Exception
     */
    private function uploadMainImage(Request $request, Ville $ville)
    {
        $path = '';

        //test si il y une image dans la requete
        if($request->file('main_photo'))
        {
            try {

                $path = $request->file('main_photo')->store('public/villes/'.$ville->id);

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