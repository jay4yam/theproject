<?php

namespace App\Http\Controllers\Back;

use App\Http\Requests\BlogUpdateRequest;
use App\Repositories\BlogRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    protected $blogRepository;

    /**
     * BlogController constructor.
     * @param BlogRepository $blogRepository
     */
    public function __construct(BlogRepository $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //on essaye de recuperer la liste des articles du blog
        try {

            $allBlogArticles = $this->blogRepository->getAll();

        }catch (\Exception $exception){
            //si il y a une exception on affiche un message d'erreur
            flash()->error($exception->getMessage());

            //on redirige vers la page précédente
            return back();
        }
        return view('back.blog.index', compact('allBlogArticles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogUpdateRequest $request)
    {
        //on essaye d'ajouter un nouvel article
        try{
            $id = $this->blogRepository->store($request);
        }catch (\Exception $exception){

            flash()->error($exception->getMessage());

            return back()->withInput();
        }

        flash()->success('Nouvel article ajouté avec succès');

        return redirect()->route('blogs.edit', ['id' => $id]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //on essaye de récupérer un article via son id
        try {
            $article = $this->blogRepository->getById($id);
        }catch (\Exception $exception){

            //si il y a une exception on renvois un message d'erreur
            flash()->error($exception->getMessage());

            //redirige vers la page précédente
            return back();
        }

        return view('back.blog.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogUpdateRequest $request, $id)
    {
        //On essaye de mettre à jour l'article
        try {

            $this->blogRepository->update($request, $id);

        }catch (\Exception $exception){

            //si il y a une exception on renvois un message d'erreur
            flash()->error($exception->getMessage());

            //on redirige vers la page précendente en ajoutant les inputs renseignés par l'internaute
            return back()->withInput();
        }

        //si tout est OK, on affiche un message
        flash()->success('Article mis à jour avec succès');

        //on redirige vers la page précédente
        return redirect()->route('blogs.edit', ['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
