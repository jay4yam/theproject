<?php
/**
 * Created by PhpStorm.
 * User: jayben
 * Date: 06/05/2018
 * Time: 16:02
 */
namespace App\Repositories;

use App\Models\Compagnie;

class CompanyRepository
{
    /**
     * @var Compagnie
     */
    protected $compagnie;

    /**
     * CompanyRepository constructor.
     * @param Compagnie $compagnie
     */
    public function __construct(Compagnie $compagnie)
    {
        $this->compagnie = $compagnie;
    }

    /**
     * Retourne une compagnie par son id
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public function getById($id)
    {
        return $this->compagnie->findOrFail($id);
    }

    /**
     * Retourne la liste paginée des compagnies
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAll()
    {
        return $allCompanies = $this->compagnie->paginate(10);
    }

    /**
     * @param $request
     * @return Compagnie
     */
    public function store($request)
    {
        $compagnie = new Compagnie();

        $this->save($compagnie, $request);

        return $compagnie;
    }

    /**
     * @param Compagnie $compagnie
     * @param $request
     */
    private function save(Compagnie $compagnie, $request)
    {
        $compagnie->raison_sociale = $request->raison_sociale;
        $compagnie->adresse = $request->adresse;
        $compagnie->code_postal = $request->code_postal;
        $compagnie->ville = $request->ville;
        $compagnie->telephone = $request->telephone;
        $compagnie->email = $request->email;
        $compagnie->mail_resa = $request->mail_resa;
        $compagnie->num_licence = $request->num_licence;
        $compagnie->baseline = 'renseignez votre baseline';
        $compagnie->intro = 'Introduction de présentation';
        $compagnie->presentation = 'Présentez votre compagnie aérienne aux internautes';
        $compagnie->logo = 'default-logo.jpg';
        $compagnie->background_image = 'defaut-background.jpg';

        $compagnie->save();

    }

    /**
     * Met à jour une compagny
     * @param $request
     * @param $id
     */
    public function update($request, $id)
    {
        $compagnie = $this->getById($id);

        $compagnie->update($request->all());

        $this->uploadFile($compagnie, $request);
    }

    /**
     * Gestion Upload de fichiers image
     * @param $compagnie
     * @param $request
     */
    private function uploadFile($compagnie, $request)
    {
        //si il y a un logo
        if($request->hasFile('logo')){
            //enregistre le fichier et set le path sur la var $path
            $path = $request->file('logo')->store('public/companies');

            //split la chaine en tableau
            $array = explode('/', $path);

            //enregistre le nom du fichier dans le model
            $compagnie->update(['logo' => $array[1].'/'.$array[2] ]);
        }

        //si il y a un backround-image
        if($request->hasFile('background_image')){
            //enregistre le fichier et set le path sur la var $path
            $path = $request->file('background_image')->store('public/companies');

            //split la chaine en tableau
            $array = explode('/', $path);

            //enregistre le nom du fichier dans le model
            $compagnie->update(['background_image' => $array[1].'/'.$array[2] ]);
        }
    }

    //TODO : Resize images
}