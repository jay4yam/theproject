<?php

namespace App\Http\Controllers\Back;

use App\Http\Requests\VilleCreateRequest;
use App\Http\Requests\VilleUpdateRequest;
use App\Repositories\VilleRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class VilleController extends Controller
{
    /**
     * @var VilleRepository
     */
    protected $villeRepository;

    /**
     * VilleController constructor.
     * @param VilleRepository $villeRepository
     */
    public function __construct(VilleRepository $villeRepository)
    {
        $this->villeRepository = $villeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        try {

            $allVilles = $this->villeRepository->getAll();

            }catch (\Exception $exception){

            flash()->error($exception->getMessage());
        }

        return view('back.ville.index', compact('allVilles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('back.ville.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  VilleCreateRequest  $request
     * @return Response
     */
    public function store(VilleCreateRequest $request)
    {
        try {
            $this->villeRepository->store($request);
        }catch (\Exception $exception){
            flash()->error($exception->getMessage());

            return back()->withInput();
        }

        flash()->success('ville crée avec succès');

        return redirect()->route('villes.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        try {

            $ville = $this->villeRepository->getById($id);

        }catch (\Exception $exception){

            flash()->error();

            return back();
        }

        return view('back.ville.edit', compact('ville'));
    }

    /**
     * @param  VilleUpdateRequest  $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(VilleUpdateRequest $request, $id)
    {
        try{

            $this->villeRepository->update($request, $id);

        }catch (\Exception $exception){

            flash()->error($exception->getMessage());

            return back()->withInput();
        }

        flash()->success('ville mise à jour avec succès');

        return redirect()->route('villes.index');
    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        //
    }
}
