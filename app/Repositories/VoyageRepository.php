<?php
/**
 * Created by PhpStorm.
 * User: jayben
 * Date: 17/05/2018
 * Time: 20:40
 */

namespace App\Repositories;


use App\Models\Voyage;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;


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
        return $this->voyage->isPublic()->with('ville', 'region')->orderBy('created_at', 'desc')->paginate(9);
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

    /**
     * Gère l'enregistrement d'un nouveau voyage
     * @param Request $request
     */
    public function store(Request $request)
    {
        $voyage = new Voyage();

        $this->save($voyage, $request);
    }

    /**
     * @param Voyage $voyage
     * @param Request $request
     */
    private function save(Voyage $voyage, Request $request)
    {
        $voyage->title = $request->title;
        $voyage->subtitle = $request->subtitle;
        $voyage->intro = $request->intro;
        $voyage->description = $request->description;
        $voyage->is_public = $request->is_public;
        $voyage->price = $request->price;
        $voyage->is_discounted = $request->is_discounted;
        $voyage->discount_price = $request->is_discounted ? $request->discount_price: 0;
        $voyage->main_photo = 'default.jpg';
        $voyage->duree_du_vol = $request->duree_du_vol;
        $voyage->ville_id = $request->ville_id;

        $voyage->save();

        if($request->has('main_photo')) {
            $voyage->main_photo = $this->uploadMainImage($request, $voyage);
            $voyage->save();
        }
    }

    /**
     * Met à jour un 'voyage'
     * @param Request $request
     * @param $id
     */
    public function update(Request $request, $id)
    {
        $voyage = $this->getById($id);

        $voyage->title = $request->title;
        $voyage->subtitle = $request->subtitle;
        $voyage->intro = $request->intro;
        $voyage->description = $request->description;
        $voyage->is_public = $request->is_public;
        $voyage->price = $request->price;
        $voyage->is_discounted = $request->is_discounted;
        $voyage->discount_price = $request->is_discounted ? $request->discount_price: 0;
        $voyage->main_photo = $this->uploadMainImage($request, $voyage);
        $voyage->duree_du_vol = $request->duree_du_vol;
        $voyage->ville_id = $request->ville_id;

        $voyage->save();
    }

    /**
     * Gère l'upload le fichier image
     * @param Request $request
     * @param Voyage $voyage
     * @return mixed
     * @throws \Exception
     */
    private function uploadMainImage(Request $request, Voyage $voyage)
    {
        //test si il y une image dans la requete
        if($request->file('main_photo'))
        {
            //on essaye d'upload le fichier
            try {
                $path = $request->file('main_photo')->store('public/voyages/'.$voyage->id);
            }catch (\Exception $exception){
                //si exception : message d'erreur
                throw new \Exception($exception->getMessage());
            }

            //split la chaîne en tableau
            $array = explode('/', $path);

            try {
                //recupere l'image qui vient d'etre uploadee
                $imgThumbNailList = Image::make('storage/' . $array[1] . '/' . $array[2] . '/' . $array[3]);
                //redimensionne l'image
                $imgThumbNailList->fit(270,240);

                //defini le chemin du fichier
                mkdir('storage/voyages/thumbnails/' . $array[2]);
                $pathList = 'storage/voyages/thumbnails/' . $array[2] . '/' . $array[3];

                //sauv. le nouveau thumbnail
                $imgThumbNailList->save($pathList);

            }catch (\Exception $exception){
                throw new \Exception($exception->getMessage());
            }

            //il faut supprimer /public/ de la chaine path, sinon on a une erreur dans le front
            //donc finalement on ne renvois que le nom du fichier
            return $array[2] . '/' .$array[3];
        }

        return $voyage->main_photo;
    }
}