<?php

namespace App\Http\Controllers\Back;

use App\Http\Helpers\ScrapHelper;
use App\Http\Requests\CreateCompanyStep1Request;
use App\Http\Requests\CreateCompanyStep2Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UploadScrapFileRequest;
use App\Repositories\CompanyRepository;
use App\Traits\uploadCSV;
use Goutte\Client;

class CompagnyController extends Controller
{
    /**
     * @var CompanyRepository
     */
    protected CompanyRepository $companyRepository;

    /**
     * CompagnyController constructor.
     * @param CompanyRepository $companyRepository
     */
    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    /**
     * Affiche l'index des compagnies (liste avec pagination)
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //on essaye de récupérer toutes les compagnies
        try {

            $allCompagnies = $this->companyRepository->getAll();

        }catch (\Exception $exception){

            //si il y a une exception, redirige page précedente avec un message d'erreur
            flash()->error($exception->getMessage());

            return back();
        }
        return view ('back.company.index', compact('allCompagnies'));
    }

    /**
     * Affiche la vue de creation de compagnie
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view ('back.company.create');
    }

    /**
     * Sauv. le step 1 de la creation de compagnie aérienne
     * @param CreateCompanyStep1Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateCompanyStep1Request $request)
    {
        //on essaye d'enregistrer une nouvelle compagnie
        try {
            $compagnie = $this->companyRepository->store($request);

        }catch (\Exception $exception){

            //si il y a une exception on redirige vers la page précédente avec un message d'erreur
            flash()->error($exception->getMessage());

            return back()->withInput();
        }

        flash()->success('Compagnie crée avec succès');

        return redirect()->route('compagnies.edit', ['compagnie' => $compagnie->id]);
    }

    /**
     * Renvois la vue de finalisation de l'inscription
     * @param int $compagny
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($compagny)
    {
        //On essaye de recuperer une compagnie via son id
        try {
            $compagnie = $this->companyRepository->getById($compagny);

        }catch (\Exception $exception) {
            //Si il y une exception on redirige vers la page précédente avec un message d'erreur
            flash()->error($exception->getMessage());

            return back();
        }
        return view('back.company.edit', compact('compagnie'));
    }

    /**
     * Met à jour la Compagnie
     * @param CreateCompanyStep2Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CreateCompanyStep2Request $request,$id)
    {
        //On essaye de mettre à jour le model
        try {

            $this->companyRepository->update($request, $id);

        }catch (\Exception $exception){
            //si il y a une exception on retourne à la page précédente avec un message d'erreur
            flash()->error($exception->getMessage());

            return back()->withInput();
        }

        //si on est là, c'est que l'update est OK, on renvois un message success
        flash()->success('Enregistrement effectué avec succes');

        return redirect()->route('compagnies.index');
    }

}
