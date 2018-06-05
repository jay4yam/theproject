<?php

namespace App\Http\Controllers\Back;

use App\Repositories\VilleRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
