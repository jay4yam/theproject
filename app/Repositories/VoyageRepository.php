<?php
/**
 * Created by PhpStorm.
 * User: jayben
 * Date: 17/05/2018
 * Time: 20:40
 */

namespace App\Repositories;


use App\Models\Compagnie;
use App\Models\Voyage;
use App\Traits\LanguageModifyer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;


class VoyageRepository
{

    use LanguageModifyer;

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
    public function allPublicVoyages()
    {
        return $this->voyage->localize()->isPublic()->with('ville', 'region')->orderBy('created_at', 'desc')->paginate(9);
    }

    /**
     * Renvois la liste des voyages
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function allVoyages()
    {
        return $this->voyage->localize()->with('ville', 'region', 'compagnies')->orderBy('created_at', 'desc')->paginate(9);
    }

    /**
     * @param $id
     * @return Model
     */
    public function getById($id)
    {
        return $this->voyage->findOrFail($id)->load('ville', 'region', 'compagnies');
    }

    /**
     * Retourne un voyage dans toutes ses langues
     * @param $id
     * @return array
     */
    public function getAllVoyageLanguageById($id)
    {
        //1. init un tableau voyages
        $arrayVoyage = array();
        $this->voyage->where('parent_id', '=', $id)
                     ->orWhere('id', '=', $id)
                     ->each(function ($voyage) use(&$arrayVoyage){
                         return $arrayVoyage[$voyage->locale] = $voyage->load('ville', 'region');
                    });
        return $arrayVoyage;
        //return $this->voyage->findOrFail($id)->load('ville', 'region');
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

        //Utilisation de la méthode copyForOtherLanguage du Trait LanguageModifyer
        $this->copyForOtherLanguage($voyage);
    }

    /**
     * @param Voyage $voyage
     * @param Request $request
     */
    private function save(Voyage $voyage, Request $request)
    {
        $voyage->locale = $request->localize;
        $voyage->parent_id = 0;
        $voyage->title = $request->title;
        $voyage->subtitle = $request->subtitle;
        $voyage->intro = $request->intro;
        $voyage->description = $request->description;
        $voyage->is_public = $request->is_public;
        $voyage->price = $request->price;
        $voyage->is_discounted = $request->is_discounted;
        $voyage->discount_price = $request->is_discounted ? $request->discount_price: 0;
        $voyage->duree_du_vol = $request->duree_du_vol;
        $voyage->ville_id = $request->ville_id;

        //Test si il y a une photo dans la requete
        if($request->has('main_photo')) {
            $voyage->main_photo = $this->uploadMainImage($request, $voyage);
        }

        //.sauv le voyage
        $voyage->save();

        //récupère le compagnie
        $compagnie = Compagnie::findOrFail($request->compagny_id);
        //test la relation voyage -> compagnie
        if(!$voyage->compagnies()->exists()){
            //.sav si n'existe pas
            $voyage->compagnies()->save($compagnie);
        }
        else{
            //.update si existe
            $voyage->compagnies()->update(['compagnies_id' => $compagnie->id]);
        }

    }

    /**
     * Met à jour un 'voyage'
     * @param Request $request
     * @param $id
     */
    public function update(Request $request, $id)
    {
        //1. recupère le voyage à updater
        $voyage = $this->voyage->findOrFail($id);

        //2. utilise la methode prive save() pour sauv. le model
        $voyage->locale = $request->localize;
        $voyage->parent_id = $request->parent_id;
        $voyage->title = $request->title;
        $voyage->subtitle = $request->subtitle;
        $voyage->intro = $request->intro;
        $voyage->description = $request->description;
        $voyage->is_public = $request->is_public;
        $voyage->price = $request->price;
        $voyage->is_discounted = $request->is_discounted;
        $voyage->discount_price = $request->is_discounted ? $request->discount_price: 0;
        $voyage->duree_du_vol = $request->duree_du_vol;
        $voyage->ville_id = $request->ville_id;

        //3. sauv. le modèle
        $voyage->save();
    }

    /**
     * Supprime un voyage
     * @param $id
     */
    public function delete($id)
    {
        $voyages = $this->getAllVoyageLanguageById($id);

        foreach ($voyages as $voyage)
        {
            $voyage->delete();
        }
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
                if( ! is_dir('storage/voyages/thumbnails/' . $array[2]))
                {
                    mkdir('storage/voyages/thumbnails/' . $array[2]);
                }

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

    /**
     * Retourne la liste des voyages filtrés par ville
     * @param Request $request
     * @return mixed
     */
    public function getVoyagesByCity(Request $request)
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

        //1. si les deux request 'price min' et 'price max' sont passés dans le form
        if(isset($request->price_min) && !isset($request->price_max)){
            return $this->voyage->localize()->isPublic()->with('ville', 'region')->where('price', '>', $request->price_min)->paginate(9);
        }

    }
}