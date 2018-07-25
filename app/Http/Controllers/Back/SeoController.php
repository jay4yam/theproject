<?php

namespace App\Http\Controllers\Back;

use App\Repositories\SeoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SeoController extends Controller
{
    /**
     * @var SeoRepository
     */
    protected $seoRepository;

    /**
     * SeoController constructor.
     * @param SeoRepository $seoRepository
     */
    public function __construct(SeoRepository $seoRepository)
    {
        $this->seoRepository = $seoRepository;
    }

    /**
     * Retourne la liste des items pouvant être "optimisés" en SEO
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $allItems = $this->seoRepository->getAll();

        return view('back.seo.index', compact('allItems'));
    }

    /**
     * Affiche le formulairre d'insertion de seo
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        $model = $this->seoRepository->getModelById($request);

        return view('back.seo.create', compact('model'));
    }

    /**
     * Gère l'enregistrement dans la table SEO
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        try {
            $this->seoRepository->store($request);

        }catch (\Exception $exception){

            flash()->error($exception->getMessage());

            return redirect()->route('seo.index');
        }

        flash()->success('Les informations SEO ont été sauvegardées');

        return redirect()->route('seo.index');
    }
}
