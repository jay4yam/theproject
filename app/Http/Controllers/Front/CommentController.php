<?php

namespace App\Http\Controllers\Front;

use App\Mail\SendAddTestimonialsMail;
use App\Models\ItemOrder;
use App\Models\MainOrder;
use App\Models\User;
use App\Repositories\CommentRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

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


    /**
     * Affiche la page a laquelle l'internaute accède après l'envois du mail le lendemain de son voyage
     * @param $locale
     * @param $order_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addTestimonials($locale, $order_id)
    {
        //1. essayer de recupérer le voyage correspondant
        $mainOrder = MainOrder::with('itemsOrder')->where('order_id', '=', $order_id)->first();

        return view('testimonials.create', compact('mainOrder'));
    }

    /**
     * Gère l'insertion du commentaire
     * @param Request $request
     */
    public function postTestimonials(Request $request)
    {
        dd($request->all());
    }
}
