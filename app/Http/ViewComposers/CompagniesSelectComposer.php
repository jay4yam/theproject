<?php
/**
 * Created by PhpStorm.
 * User: jayben
 * Date: 09/05/2018
 * Time: 10:31
 */

namespace App\Http\ViewComposers;
use App\Models\Compagnie;
use Illuminate\View\View;


class CompagniesSelectComposer
{
    /**
     * @var Compagnie
     */
    protected $compagnie;

    /**
     * CompagniesSelectComposer constructor.
     * @param Compagnie $compagnie
     */
    public function __construct(Compagnie $compagnie)
    {
        $this->compagnie = $compagnie;
    }

    /**
     * Retourne un tableau contenant l'id et la raison sociale de toutes les compagnies enregistrées
     * @return \Illuminate\Support\Collection
     */
    private function getCompagniesListingToArray()
    {
        return $this->compagnie->all(['id', 'raison_sociale', 'code_postal', 'ville'])->pluck('raison_sociale', 'id');
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('compagnies', $this->getCompagniesListingToArray());
    }
}