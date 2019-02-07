<?php

namespace App\Http\Controllers\Front;

use App\Models\MainOrder;
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
     * @param $locale
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
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


    public function addTestimonials($locale, $order_id)
    {
        //1. essayer de recupérer le voyage correspondant
        $mainOrder = MainOrder::with('itemsOrder')->where('order_id', '=', $order_id)->first();

        return view('testimonials.create', compact('mainOrder'));
    }

    public function postTestimonials(Request $request)
    {
        dd($request->all());
    }
}
