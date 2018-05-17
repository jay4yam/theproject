<?php

namespace App\Http\Controllers\Front;

use App\Repositories\CommentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    /**
     * @var CommentRepository
     */
    protected $commentRepository;

    /**
     * CommentController constructor.
     * @param CommentRepository $commentRepository
     */
    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    /**
     * Ajoute un commentaire
     * @param $locale
     * @param Request $request
     */
    public function addComment($locale, Request $request)
    {
        try {
            //gère l'insertion d'un commentaire
            $this->commentRepository->store($request);

        }catch (\Exception $exception){
            //si exception, on affiche un message d'erreur
            flash()->error($exception->getMessage());

            return redirect()->back();
        }

        return redirect()->back();
    }
}
