<?php

namespace App\Http\Controllers\Back;

use App\Http\Requests\CreateCompanyStep1;
use App\Http\Requests\CreateCompanyStep1Request;
use App\Http\Requests\CreateCompanyStep2Request;
use App\Models\Compagnie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\CompanyRepository;

class CompagnyController extends Controller
{

    /**
     * @var CompanyRepository
     */
    protected $companyRepository;

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
        $allCompagnies = $this->companyRepository->getAll();
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
     * @param CreateCompanyStep1 $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateCompanyStep1Request $request)
    {
        $compagnie = $this->companyRepository->store($request);

        return redirect()->route('compagny.edit', ['compagnie' => $compagnie->id]);
    }

    /**
     * Renvois la vue de finalisation de l'inscription
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $compagnie = $this->companyRepository->getById($id);

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
        $this->companyRepository->update($request, $id);

        return redirect()->route('compagny.index');
    }
}
