<?php
/**
 * Created by PhpStorm.
 * User: jayben
 * Date: 13/07/2018
 * Time: 17:41
 */
namespace App\Traits;

use Illuminate\Database\Eloquent\Model;

trait LanguageModifyer
{
    /**
     * Crée une copie du model inséré en base pour chaque langues disponibles
     * @param Model $model
     */
    private function copyForOtherLanguage(Model $model)
    {
        //1. recupère toutes les langues disponibles sur la plateforme
        $arrayLanguage = \Config::get('language');

        //2. supprime la langue du voyage passé en paramètre
        unset($arrayLanguage[$model->locale]);

        //3. Itère sur la liste des langues pour créer une copie du voyage passé en paramètre
        foreach($arrayLanguage as $locale => $value)
        {
            $modelCopy = $model->replicate();
            $modelCopy->locale = $locale;
            $modelCopy->parent_id = $model->id;
            $modelCopy->is_public = false;
            $modelCopy->save();
        }
    }
}