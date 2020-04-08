<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ScrapHelper;
use App\Http\Requests\UploadScrapFileRequest;
use App\Repositories\ScrapUrlRepository;
use App\Repositories\VoyageRepository;
use App\Traits\uploadCSV;
use Illuminate\Support\Facades\Log;

class ScrapController extends Controller
{
    use uploadCSV;

    protected ScrapUrlRepository $scrapRepostiory;

    /**
     * ScrapController constructor.
     * @param  ScrapUrlRepository  $scrapRepostiory
     */
    public function __construct(ScrapUrlRepository $scrapRepostiory)
    {
        $this->scrapRepostiory = $scrapRepostiory;
    }

    public function index()
    {
        $urls = $this->scrapRepostiory->getAll();

        return view('back.scrap.index', compact('urls'));
    }

    /**
     * Gère l'upload le fichier CSV
     * @param  UploadScrapFileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function uploadScrapeFile(UploadScrapFileRequest $request)
    {
        //1. sauv & upload le fichier
        $this->upload($request);

        //2. utilise le fichier pour peupler la base
        $this->scrapRepostiory->storeFromFile($request);

        return back();
    }

    /**
     * Récupère les info sur les voyages peupler en base
     * @param  ScrapHelper  $scrapHelper
     * @param  VoyageRepository  $repository
     * @return \Illuminate\Http\RedirectResponse
     */
    public function scrapeData(ScrapHelper $scrapHelper, VoyageRepository $repository)
    {
        //1. recupère la liste des urls à scrapper (stockées en base)
        $urls = $this->scrapRepostiory->getJobWait();

        //2. boucle sur chacune des url
        foreach ($urls as $url)
        {
            try {
                //.3 récupère la data via le scrapHelper
                $data = $scrapHelper->getData($url);

                //4. passe par le repo pour créer un objet request
                $request = $scrapHelper->makeRequestObject($data);

                //5. passe la requête dans le repo Voyage
                $repository->store($request);

                //6.1 update le status de l'url pour ne pas la ré-uploader
                $url->status = 'done';
                $url->save();
            }catch (\Exception $exception){
                //6.2 update le status de l'url si echec
                $url->status = 'failed';
                $url->save();
                \Log::error('scrap url impossible :'.$url->url);
            }
        }

        return back();
    }
}
