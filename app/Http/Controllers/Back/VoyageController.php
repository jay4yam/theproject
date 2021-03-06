<?php

namespace App\Http\Controllers\Back;

use App\Http\Requests\VoyageCreateRequest;
use App\Http\Requests\VoyageUpdateRequest;
use App\Repositories\VoyageRepository;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class VoyageController extends Controller
{
    /**
     * @var VoyageRepository
     */
    protected $voyageRepository;

    /**
     * VoyageController constructor.
     * @param VoyageRepository $voyageRepository
     */
    public function __construct(VoyageRepository $voyageRepository)
    {
        $this->voyageRepository =$voyageRepository;
    }

    /**
     * retourne la vue avec la liste des voyages
     * @return Factory|RedirectResponse|View
     */
    public function index()
    {
        //on essaye de recup la liste de tous les voyages pagines
        try {

            $allVoyages = $this->voyageRepository->getAll();

        }catch (\Exception $exception){

            flash()->error($exception->getMessage());

            return back();
        }

        return view('back.voyage.index', compact('allVoyages'));
    }

    /**
     * Affiche la vue edit voyage
     * @param $voyage
     * @return Factory|View
     */
    public function edit($voyage)
    {
        //1. recupère le voyage et toutes les langues via l'id du voyage principale
        $voyages = $this->voyageRepository->getAllVoyageLanguageById($voyage);

        return view('back.voyage.edit', compact('voyages'));
    }

    /**
     * Affiche la vue create voyage
     * @return Factory|View
     */
    public function create()
    {
        return view('back.voyage.create');
    }

    /**
     * request pour ajout d'un nouveau voyage
     * @param VoyageCreateRequest $request
     * @return $this|RedirectResponse
     */
    public function store(VoyageCreateRequest $request)
    {
        try {

            $this->voyageRepository->store($request);

        }catch (\Exception $exception){

            flash()->error($exception->getMessage());

            return back()->withInput();
        }

        flash()->success('nouveau voyage enregistré');

        return redirect()->route('voyages.index');
    }

    /**
     * Request user pour maj 'voyage'
     * @param VoyageUpdateRequest $request
     * @param $voyage
     * @return $this|RedirectResponse
     */
    public function update(VoyageUpdateRequest $request, $voyage)
    {
        try {
            $this->voyageRepository->update($request, $voyage);

        }catch (\Exception $exception){

            flash()->error($exception->getMessage());

            return back()->withInput();
        }

        flash()->success('Voyage mis à jour avec succès');

        //si le parent_id est différents alors il faut rediriger vers la page parente
        if($request->parent_id != $voyage && $request->parent_id !=0){
            return redirect()->route('voyages.edit', ['voyage' => $this->voyageRepository->getById($request->parent_id)]);
        }

        return redirect()->route('voyages.edit', ['voyage' => $this->voyageRepository->getById($voyage)]);
    }

    /**
     * Supprime un voyage de la base, (supprime aussi tous les voyages fils dans toutes les langues
     * @param $voyage
     * @return $this|string
     */
    public function destroy($voyage)
    {
        try {

            $this->voyageRepository->delete($voyage);

        }catch (\Exception $exception){

            flash()->error($exception->getMessage());

            return back();
        }

        flash()->error('voyage supprimé');

        return back();
    }

    /**
     * Gestion de l'upload d'image via dropzone.js
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function uploadMiniature(Request $request)
    {
        if($request->file('file')) {
            //on essaye d'upload le fichier
            try {
                $request->file('file')->store('public/voyages/' . $request->voyage_id . '/min');
            } catch (\Exception $exception) {
                //si exception : message d'erreur
                throw new \Exception($exception->getMessage());
            }
            return response('success');
        }
        return response('no-file');
    }

    /**
     * Supprime une image miniature
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function deleteMiniature(Request $request)
    {
        if($request->has('file')){
            try{
                unlink ( 'storage'.$request->file );
            }catch (\Exception $exception){
                return response(['error' => $exception->getMessage() ]);
            }
            return response(['success']);
        }

        return response(['error' => 'aucun fichier valide']);
    }
}
