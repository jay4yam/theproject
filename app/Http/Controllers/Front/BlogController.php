<?php

namespace App\Http\Controllers\Front;

use App\Models\Blog;
use App\Models\Categories;
use App\Http\Controllers\Controller;
use App\Models\Tag;

class BlogController extends Controller
{
    /**
     * @var Blog
     */
    protected $blog;

    /**
     * @var Categories
     */
    protected $categorie;

    /**
     * BlogController constructor.
     * @param Blog $blog
     * @param Categories $categories
     */
    public function __construct(Blog $blog, Categories $categories)
    {
        $this->blog = $blog;
        $this->categorie = $categories;
    }

    /**
     * Retourne la vue index avec tous les articles paginés par date
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function index()
    {
        //On essaye de recupérer la liste des articles du blog en mode pagination
        try {

            $allArticles = $this->blog->isPublic()->with('user', 'categories')->orderBy('created_at', 'desc')->paginate(6);

        }catch (\Exception $exception){
            //si il y a une exception on affiche un message d'erreur
            flash()->error($exception->getMessage());

            //on redirige vers la page précedente
            return back();
        }

        return view('blog.index', compact('allArticles'));
    }

    /**
     * Retourne la vue avec les articles filtrés par catégories
     * @param $locale
     * @param $id
     * @param $categorie
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function categorie($locale, $id, $categorie)
    {
        //on essaye de récupérer la liste des article appartenant à une catégorie
        try {

            //récupère la premiere cat dont l'id est passée en param avec un lazyloading du model blog
            $categories = $this->categorie->with('postsPublished')->where('id', $id)->first();


        }catch (\Exception $exception){
            //si il y a une exception on affiche un message d'erreur
            flash()->error($exception->getMessage());

            //on redirige vers la page précendente en mode erreur serveur
            return back();
        }

        //renvois la vue categorie avec les catégories
        return view('blog.categorie', compact('categories'));
    }

    /**
     * Retourne la vue filtrée par tag
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function filterByTag($locale, $id)
    {
        try {

            $allArticles = $this->blog->whereHas('tags', function ($query) use ($id) {
                $query->where('taggables.taggable_id', '=', $id);
            })->paginate(6);

        }catch (\Exception $exception){

            flash()->error($exception->getMessage());

            return redirect()->route('blog.index', ['locale' => \App::getLocale()]);
        }

        return view('blog.index', compact('allArticles'));
    }

    /**
     * Affiche un article
     * @param $locale
     * @param $id
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($locale, $id, $slug)
    {
        //On essaye de récupère l'article
        try {

            $article = $this->blog->with('user', 'categories', 'comments', 'tags')->where('id', $id)->firstOrFail();

        }catch (\Exception $exception){

            flash()->error($exception->getMessage());

            return redirect()->route('blog.index', ['locale' => \App::getLocale()]);
        }
        return view('blog.show', compact('article'));
    }
}
