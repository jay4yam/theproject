<?php

/**
 * Created by PhpStorm.
 * User: jayben
 * Date: 05/05/2018
 * Time: 13:25
 */

namespace App\Http\ViewComposers;
use Illuminate\View\View;

class AlternateHrefLangueComposer
{
    /**
     * @var string
     */
    protected $currentLangue;

    /**
     * AlternateHrefLangueComposer constructor.
     */
    public function __construct(){
        $this->currentLangue = \App::getLocale();
    }

    /**
     * retourne toutes les langues disponibles dans la plateforme
     * @return array
     */
    private function getAllLanguageAvailable()
    {
        return \Config::get('language');
    }

    /**
     * Retourne les langues qui ne sont pas la langue courante utilisée
     * @return array|string
     */
    private function getAlternateLanguage()
    {
        return $notCurrentLanguage = array_except( $this->getAllLanguageAvailable(), $this->currentLangue);
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('alternateTags', $this->getAlternateLanguage());
    }
}