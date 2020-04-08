<?php


namespace App\Http\Helpers;


use App\Interfaces\iScrap;
use App\Models\Compagnie;
use App\Models\ScrapUrl;
use Goutte\Client;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class ScrapHelper
{
    public int $compagny_id;

    /**
     * Fabrique une requête pour faire passer dans le voyageRepository (sans ajout de code pour les nouveaux enregistrement
     * @param  array  $data
     * @return Request
     */
    public function makeRequestObject(array $data)
    {
        $request = new Request();

        $request->setMethod('POST');

        $request->request->add($data);

        $request->files->set('main_photo', $data['main_photo']);

        return $request;
    }

    /**
     * Récupère la data de l'url
     * @param  ScrapUrl  $url
     * @return array
     * @throws \Exception
     */
    public function getData(ScrapUrl $url)
    {
        try {
            //1. récupère le type de scraper en fonction de l'id de la compagnie
            $scraperType = $this->getScraper($url);

            //sortie si l'url n'existe pas
            if($scraperType->responseCode == '404') throw new \Exception('impossible de ping l\'url');

            //2. récupérer la data de l'url
             $datas = $this->getDataFromUrl($scraperType);

        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
        return $datas;
    }

    /**
     * Retourne le type de scraper
     * @param  ScrapUrl $url
     * @return AzurHelicoScraper|JetSystemScraper
     */
    private function getScraper(ScrapUrl $url)
    {
        switch ($url->compagnie->id)
        {
            case 1:
                return new AzurHelicoScraper($url->url, $url->compagnie->id);
                break;
            case 2:
                return new JetSystemScraper($url->url, $url->compagnie->id);
                break;
        }
    }

    /**
     * Retourne la data contenus dans la page qui a été scrapée
     * @param  iScrap  $scrap
     * @return array
     */
    private function getDataFromUrl(iScrap $scrap)
    {
        return [
            'localize' => 'fr',
            'parent_id' => 0,
            'title' => $scrap->getTitle(),
            'subtitle' => $scrap->getSubtitle(),
            'intro' => $scrap->getIntro(),
            'description' => $scrap->getDescription(),
            'is_public' => false,
            'price' => $scrap->getPrice(),
            'is_discounted' => false,
            'discount_price' => 0,
            'duree_du_vol' => $scrap->getDureeDuVol(),
            'main_photo' => new UploadedFile(storage_path('app/public/tmp/'.$scrap->getMainPhoto()), $scrap->getMainPhoto()),
            'ville_id' => 1,
            'compagny_id' => $scrap->getCompagnyId(),
        ];
    }
}