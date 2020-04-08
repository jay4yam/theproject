<?php


namespace App\Traits;


use App\Models\User;
use Illuminate\Http\Request;

trait uploadCSV
{
    public function upload(Request $request)
    {
        //test si il y un fichier scrapfile dans la requête
        if($request->file('scrapfile')) {
            try {

                $request->file('scrapfile')
                        ->storeAs('public/csv/'.$request->compagny_id,
                                'import-csv-'.date('d-m-Y-h-m').'.'.$request->file('scrapfile')->getClientOriginalExtension());

            } catch (\Exception $exception) {
                //si exception : message d'erreur
                throw new \Exception($exception->getMessage());
            }
        }
    }
}