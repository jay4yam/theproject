<?php

namespace App\Http\Controllers\Front;

use App\Repositories\CompanyRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompagnieController extends Controller
{
    protected $compagnyRepository;

    public function __construct(CompanyRepository $companyRepository)
    {
        $this->compagnyRepository = $companyRepository;
    }

    public function show($locale, $id, $companyName)
    {
        $compagny = $this->compagnyRepository->getById($id);

        $compagny->load('voyages');

        return view('compagnies.show', compact('compagny'));
    }
}
