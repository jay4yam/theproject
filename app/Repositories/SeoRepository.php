<?php
/**
 * Created by PhpStorm.
 * User: jayben
 * Date: 22/07/2018
 * Time: 10:26
 */

namespace App\Repositories;


use App\Models\Blog;
use App\Models\Seo;
use App\Models\Voyage;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class SeoRepository
{
    /**
     * @var Seo
     */
    protected $seo;

    /**
     * SeoRepository constructor.
     * @param Seo $seo
     */
    public function __construct(Seo $seo)
    {
        $this->seo = $seo;
    }

    /**
     * Retourne l'objet seo
     * @param Request $request
     * @return Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function getModelById(Request $request)
    {
        $id = $request->id;

        switch ($request->type){
            case ('Voyage'):
                return Voyage::findOrFail($id)->load('seo');
                break;
        }
        return null;
    }

    /**
     * Retourne la liste des items seotable
     * @return Collection
     */
    public function getAll()
    {
        $collect = new Collection();

        Voyage::all(['id', 'title'])->each(function ($model) use (&$items, &$collect){
            $collect->add(['type' => 'Voyage', 'model' => $model]);
        });

        Blog::all(['id', 'title'])->each(function($model) use (&$items, &$collect){
            $collect->add(['type' => 'Blog', 'model' => $model]);
        });

        return $collect;
    }

    /**
     * Méthode appelée par la méthode store du seo Controller pour gérer l'enregistrement
     * @param Request $request
     */
    public function store(Request $request)
    {
        $this->save($request);
    }

    /**
     * Méthode privée qui gère l'enregistrement
     * @param Seo $seo
     * @param Request $request
     */
    private function save(Request $request)
    {
        switch ($request->type) {
            case ('Voyage') :
                //recupere le voyage via son id
                $voyage = Voyage::findOrFail($request->model_id);

                //enregistre les attributs seo
                $voyage->seo()->create(['locale' => $request->localize,
                'title' => $request->title,
                'meta_robots' => $request->meta_robots,
                'meta_description' => $request->meta_description,
                'canonical' => $request->canonical,]);

                break;
        }
    }
}