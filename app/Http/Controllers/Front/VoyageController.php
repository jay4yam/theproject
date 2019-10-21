<?php

namespace App\Http\Controllers\Front;

use App\Http\Helpers\FilterVoyages;
use App\Repositories\VoyageRepository;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VoyageController extends Controller
{
    /**
     * @var
     */
    protected $voyageRepository;

    /**
     * VoyageController constructor.
     * @param VoyageRepository $voyageRepository
     */
    public function __construct(VoyageRepository $voyageRepository)
    {
        $this->voyageRepository = $voyageRepository;
    }

    /**
     * Retourne la vue contenant tous les voyages
     * @return Factory|View
     */
    public function allVoyages()
    {
        try {

            $allVoyages = $this->voyageRepository->allPublicVoyages();

        }catch (\Exception $exception){

            flash()->error($exception->getMessage());

            return redirect()->route('home');
        }

        return view('voyages.index', compact('allVoyages'));
    }

    /**
     * Retourne la vue show.voyage
     * @param $locale
     * @param $id
     * @param $lug
     * @return Factory|View
     */
    public function showVoyage($locale, $id, $lug)
    {
        try {

            $voyage = \Cache::remember('voyage' . $id, 10, function () use ($id) {
                return $this->voyageRepository->getById($id);
            });

            $voyagesInRegion = \Cache::remember('voyageInRegion' . $id, 10, function () use ($voyage) {
                return $this->voyageRepository->getVoyagesInRegion($voyage);
            });

        }catch (\Exception $exception){
            flash()->error($exception->getMessage());
            return back();
        }

        return view('voyages.show', compact('voyage', 'voyagesInRegion'));
    }

    /**
     * @param  Request  $request
     * @param  FilterVoyages  $filterVoyages
     * @return Factory|View
     */
    public function filterVille(Request $request, FilterVoyages $filterVoyages)
    {
        try{
            $allVoyages = $filterVoyages->getVoyagesByCity($request);
        }catch (\Exception $exception){
            flash()->error($exception->getMessage());

            return back();
        }
        return view('voyages.index', compact('allVoyages'));
    }

    /**
     * @param  Request  $request
     * @param  FilterVoyages  $filterVoyages
     * @return Factory|View
     */
    public function filterPrice(Request $request, FilterVoyages $filterVoyages)
    {
        try {
            $allVoyages = $filterVoyages->getVoyagesByPrice($request);
        }catch (\Exception $exception){
            flash()->error($exception->getMessage());
            return back();
        }
        return view('voyages.index', compact('allVoyages'));
    }
}
