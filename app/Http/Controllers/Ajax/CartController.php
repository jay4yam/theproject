<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Helpers\CartHelper;
use App\Http\Requests\AddToCartAjaxRequest;
use App\Http\Requests\RemoveCartAjaxRequest;
use App\Http\Requests\UpdateCartAjaxRequest;
use App\Http\Requests\VoyageIdRequest;
use App\Models\Voyage;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class CartController extends Controller
{

    /**
     * @var Voyage
     */
    protected $voyage;
    protected $cart;

    /**
     * CartController constructor.
     * @param  Voyage  $voyage
     * @param CartHelper $cart
     */
    public function __construct(Voyage $voyage, CartHelper $cart)
    {
        $this->voyage = $voyage;
        $this->cart = $cart;
    }

    /**************************************/
    /*      AJAX REQUEST FOR CART         */
    /*************************************/

    /**
     * Retourne les infos d'un voyage
     * @param VoyageIdRequest $request
     * @return ResponseFactory|JsonResponse|Response
     */
    public function getVoyagesInfoForCart(VoyageIdRequest $request)
    {
        try {

            $voyageId = $request->id;

            $voyage = $this->voyage->findOrFail($voyageId, ['id', 'price', 'is_discounted', 'discount_price', 'title', 'main_photo']);

        }catch (\Exception $exception){
            return response(['fail' => $exception->getMessage()]);
        }

        return response()->json(['success' => true, 'voyage' => $voyage]);
    }

    /**
     * Ajoute le voyage au panier
     * @param AddToCartAjaxRequest $request
     * @param CartHelper $cart
     * @return JsonResponse
     */
    public function addVoyageToCart(AddToCartAjaxRequest $request)
    {
        try {
            //init. voyageId
            $voyageId = $request->voyageId;

            //recupere le voyage via son id
            $voyage = $this->voyage->findOrFail($voyageId, ['id', 'title', 'main_photo', 'price', 'discount_price']);

            //Sauv. du cart en session
            $this->cart->save($request, $voyage);

        } catch (\Exception $exception) {
            //si il y a une erreur on renvois fail à la fonction 'ajax'
            return response()->json(['fail' => true, 'message' => $exception->getMessage()]);
        }

        //sinon on renvois les datas en json à la fonction ajax.
        return response()
            ->json([
                'success' => true,
                'cartKey' => $this->cart->getCartKey(),
                'voyage' => $this->cart->getVoyage(),
                'numOfVoyage' => count(session()->get('cart'))
            ]);
    }

    /**
     * Supprime un des voyages du panier
     * Repond à un click de l'utilisateur sur le bouton 'deletefromcart'
     * @param Request $request
     * @return JsonResponse
     */
    public function removeFromCart(RemoveCartAjaxRequest $request)
    {
        try {
            //Supprime un voyage du tableau 'cart' en session
            $this->cart->deleteVoyageFromCart($request);

        }catch (\Exception $exception){

            //si il y a une erreur on renvois un message d'erreur
            return response()->json(['fail' => true, 'message' => $exception->getMessage() ]);
        }

        //si la maj est ok, on renvois le nouveau nombre de voyage(s) présent(s) dans le tableau "cart'
        return response()->json(['success' => true, 'numOfVoyage' => count(session()->get('cart')) ]);
    }

    /**
     * Response à la Mise à jour de la quantité d'un voyage par l'utilisateur
     * @param UpdateCartAjaxRequest $request
     * @return JsonResponse
     */
    public function updateQuantity(UpdateCartAjaxRequest $request)
    {
        try{
            //on essaye d'updater la quantité du nombre de voyageur d'un des voyages du panier
            $this->cart->updateQuantity($request);

        }catch (\Exception $exception){
            //si il y a une erreur on renvois un message d'erreur
            return response()->json(['fail' => true, 'message' => $exception->getMessage() ]);
        }

        //si la maj est ok, on renvois le nouveau nombre de voyage(s) présent(s) dans le tableau "cart'
        return response()->json(['success' => true, 'numOfVoyage' => count(session()->get('cart')) ]);
    }

    /**************************************/
    /*     END AJAX REQUEST FOR CART         */
    /*************************************/
}
