<?php

namespace App\Http\Controllers\Back;

use App\Http\Requests\VoyageCreateRequest;
use App\Http\Requests\VoyageUpdateRequest;
use App\Repositories\VoyageRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function index()
    {
        //on essaye de recup la liste de tous les voyages pagines
        try {

            $allVoyages = $this->voyageRepository->allVoyages();

        }catch (\Exception $exception){

            flash()->error($exception->getMessage());

            return back();
        }

        return view('back.voyage.index', compact('allVoyages'));
    }

    /**
     * Affiche la vue edit voyage
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $voyage = $this->voyageRepository->getById($id);

        return view('back.voyage.edit', compact('voyage'));
    }

    /**
     * Affiche la vue create voyage
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('back.voyage.create');
    }

    /**
     * request pour ajout d'un nouveau voyage
     * @param VoyageCreateRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse
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
     * @param Request $request
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function update(VoyageUpdateRequest $request, $id)
    {
        try {

            $this->voyageRepository->update($request, $id);

        }catch (\Exception $exception){

            flash()->error($exception->getMessage());

            return back()->withInput();
        }

        flash()->success('Voyage mis à jour avec succès');

        return redirect()->route('voyages.edit', ['voyage' => $this->voyageRepository->getById($id)]);
    }

    /**
     * Gestion de l'iupload d'image via dropzone.js
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
