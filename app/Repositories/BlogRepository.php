<?php
/**
 * Created by PhpStorm.
 * User: jayben
 * Date: 09/05/2018
 * Time: 23:42
 */

namespace App\Repositories;


use App\Models\Blog;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Intervention\Image\Image;

class BlogRepository
{
    /**
     * @var Blog
     */
    protected $blog;

    /**
     * BlogRepository constructor.
     * @param Blog $blog
     */
    public function __construct(Blog $blog)
    {
        $this->blog = $blog;
    }

    /**
     * Retourne 1 article via son id
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public function getById($id)
    {
        return $this->blog->findOrFail($id);
    }

    /**
     * Retourne les articles paginés par 10 ordonnés par date
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAll()
    {
        return $this->blog->with('user', 'categories')->orderBy('created_at', 'DESC')->paginate(10);
    }

    /**
     * Gère l'insertion d'un nouvel article
     * @param Request $request
     */
    public function store(Request $request)
    {
        $article = new Blog();

        return $this->save($article, $request);
    }

    /**
     * @param Blog $article
     * @param Request $request
     */
    private function save(Blog $article, Request $request)
    {
        \DB::transaction(function () use($request, $article){

            $article->user_id = $request->user_id;
            $article->title = $request->title;
            $article->slug = $request->slug;
            $article->intro = $request->intro;
            $article->content = $request->contentArticle;
            $article->is_public = $request->is_public;

            $article->main_image = $this->uploadMainImage($request, $article);

            //Sauv. l'article avec les nouveaux 'attributs'
            $article->save();

            //Gère la synchro de l'article avec
            $this->updateCategories($request, $article);
        });

        return $article->id;
    }

    /**
     * Gère l'update du model 'article'
     * @param Request $request
     * @param $id
     */
    public function update(Request $request, $id)
    {
        $article = $this->blog->findOrFail($id);

        \DB::transaction(function () use($request, $id, $article){

            $article->title = $request->title;
            $article->slug = $request->slug;
            $article->intro = $request->intro;
            $article->content = $request->contentArticle;
            $article->is_public = $request->is_public;

            $article->main_image = $this->uploadMainImage($request, $article);

            //Sauv. l'article avec les nouveaux 'attributs'
            $article->save();

            //Gère la synchro de l'article avec
            $this->updateCategories($request, $article);
        });
    }

    /**
     * Met à jour les catégories et l'article via la methode sync
     * @param Request $request
     * @param Blog $article
     */
    private function updateCategories(Request $request, Blog $article)
    {
        if($request->input('categorie'))
        {
            $article->categories()->sync($request->categorie);
        }
    }

    /**
     * Gère l'upload le fichier image
     * @param $request
     * @param Blog $article
     * @return mixed|string
     */
    private function uploadMainImage(Request $request, Blog $article)
    {
        //test si il y une image dans la requete
        if($request->file('main_image'))
        {
            //on essaye d'upload le fichier
            try {
                $path = $request->file('main_image')->store('public/blog');
            }catch (\Exception $exception){
                //si exception : message d'erreur
                throw new \Exception($exception->getMessage());
            }

            //split la chaîne en tableau
            $array = explode('/', $path);

            try {
                //recupere l'image qui vient d'etre uploadee
                $imgThumbNailList = \Image::make('storage/' . $array[1] . '/' . $array[2]);
                //redimensionne l'image
                $imgThumbNailList->fit(275);
                //defini le chemin du fichier
                $pathList = 'storage/blog/thumbnails/' . $array[2];
                //sauv. le nouveau thumbnail
                $imgThumbNailList->save($pathList);

            }catch (\Exception $exception){
                throw new \Exception($exception->getMessage());
            }

            //il faut supprimer /public/ de la chaine path, sinon on a une erreur dans le front
            //donc finalement on ne renvois que le nom du fichier
            return $array[2];
        }

        return $article->main_image;
    }
}