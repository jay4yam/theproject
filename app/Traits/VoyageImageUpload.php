<?php


namespace App\Traits;


use App\Models\Voyage;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

trait VoyageImageUpload
{
    /**
     * Gère l'upload le fichier image
     * @param Request $request
     * @param Voyage $voyage
     * @return mixed
     * @throws \Exception
     */
    public function uploadMainImage(Request $request, Voyage $voyage)
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
}