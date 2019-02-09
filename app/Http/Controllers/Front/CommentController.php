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


    /**
     * Affiche la page a laquelle l'internaute accède après l'envois du mail le lendemain de son voyage
     * @param $locale
     * @param $order_id
     * @param $voyage_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addTestimonials($locale, $order_id, $voyage_id)
    {
        if(\Auth::check()) {
            try {
                //1. essayer de recupérer le voyage correspondant
                $mainOrder = MainOrder::with(array('itemsOrder' => function ($query) use ($voyage_id) {
                    $query->where('voyage_id', '=', $voyage_id);
                }))->where('order_id', '=', $order_id)->first();

                //Test si l'utilisateur qui tente de commenter le voyage est bien le propriétaire du voyage
                if(\Auth::id() != $mainOrder->user->id){
                    return view('errors.404')->with(['message' => 'vous ne pouvez pas commenter ce voyage']);
                }

            } catch (\Exception $exception) {
                return view('errors.404')->with(['message' => $exception->getMessage()]);
            }
        }else {
            $url = \request()->path();

            session()->put('testimonials', $url);

            return redirect()->route('login');
        }

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
