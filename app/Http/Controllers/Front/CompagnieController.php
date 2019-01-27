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

    public function show($locale, $id, $companyName)
    {
        $compagny = $this->compagnyRepository->getById($id);

        $compagny->load('voyages');

        return view('compagnies.show', compact('compagny'));
    }

    public function contactCompagnie(Request $request, MessageRepository $messageRepository){
        $messageRepository->store($request->all());
        return back()->with(['message' => 'Merci, la compagnie reviendra vers vous rapidement']);
    }
}
