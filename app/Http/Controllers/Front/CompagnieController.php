<?php

namespace App\Http\Controllers\Front;

use App\Repositories\CompanyRepository;
use App\Repositories\MessageRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompagnieController extends Controller
{
    protected $compagnyRepository;

    public function __construct(CompanyRepository $companyRepository)
    {
        $this->compagnyRepository = $companyRepository;
    }

    /**
     * Affiche la page de présentation de la compagnie avec ses voyages
     * @param $locale
     * @param $id
     * @param $companyName
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($locale, $id, $companyName)
    {
        $compagny = $this->compagnyRepository->getById($id);

        $compagny->load('voyages');

        return view('compagnies.show', compact('compagny'));
    }

    /**
     * Gère l'envois d'un message par l'utilisateur à une compagnie
     * @param Request $request
     * @param MessageRepository $messageRepository
     * @return \Illuminate\Http\RedirectResponse
     */
    public function contactCompagnie(Request $request, MessageRepository $messageRepository)
    {
        $messageRepository->store($request->all());

        return back()->with(['message' => 'Merci, la compagnie reviendra vers vous rapidement']);
    }
}
