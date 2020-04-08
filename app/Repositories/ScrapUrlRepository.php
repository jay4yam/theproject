<?php


namespace App\Repositories;


use App\Models\ScrapUrl;
use App\Models\Voyage;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\File;

class ScrapUrlRepository
{
    protected ScrapUrl $scrapUrl;

    /**
     * ScrapUrlRepository constructor.
     * @param  ScrapUrl  $scrapUrl
     */
    public function __construct(ScrapUrl $scrapUrl)
    {
        $this->scrapUrl = $scrapUrl;
    }

    /**
     * Retourne la collection de toutes les urls
     * @return ScrapUrl[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return $this->scrapUrl->with('compagnie')->get();
    }

    /**
     * Retourne la liste des url qui ont le status "wait"
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getJobWait(){
        return $this->scrapUrl->with('compagnie')->where('status', '=', 'wait')->get();
    }


    /**
     * Gère l'enregistrement des url du fichier en base
     * @param  Request  $request
     * @throws \Exception
     */
    public function storeFromFile(Request $request):void
    {
        try{
            $this->save($request->file('scrapfile'), $request->compagny_id);
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    /**
     * Enregistre les données en base
     * @param int $id
     * @param  File  $file
     */
    private function save(File $file, int $id):void
    {
        //1. lis le contenus du fichier
        $file = $file->openFile();

        //2. boucle sur le fichier pour récupérer toutes les lignes
        $tmp = [];
        while (!$file->eof()){
            $tmp [] = $file->fgetcsv();
        }

        //3. applati tous les tableaux renvoyés par fgetcsv en un seul
        $data = array_flatten($tmp);

        //4. boucle sur les data pour insertion en base
        foreach ($data as $url)
        {
            $scrap = new ScrapUrl();

            $scrap->url = $url;

            $scrap->compagnie_id = $id;

            $scrap->save();
        }
    }
}