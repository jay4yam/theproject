<?php
/**
 * Created by PhpStorm.
 * User: jayben
 * Date: 20/05/2018
 * Time: 22:41
 */

namespace App\Http\ViewComposers;

use App\Models\Voyage;
use Illuminate\View\View;

class last6product4homeComposer
{
    /**
     * @var Voyage
     */
    protected $voyage;

    /**
     * last6product4homeComposer constructor.
     * @param Voyage $voyage
     */
    public function __construct(Voyage $voyage)
    {
        $this->voyage = $voyage;
    }

    /**
     * Retourne les 6 derniers articles
     * @return mixed
     */
    private function getLast6voyages()
    {
        return $this->voyage->localize()->isPublic()->with('ville', 'region')->orderBy('created_at', 'desc')->limit(6)->get();
    }

    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->with([
            'last6articles' => $this->getLast6voyages()
        ]);
    }
}