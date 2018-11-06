<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Helpers\CartHelper;
use App\Models\Voyage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{

    protected $voyage;

    public function __construct(Voyage $voyage)
    {
        $this->voyage = $voyage;
    }

    /**************************************/
    /*      AJAX REQUEST FOR CART         */
    /*************************************/

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addVoyageToCart(Request $request)
    {
        try {
            //init. voyageId
            $voyageId = $request->voyageId;

            //recupere le voyage via son id
            $voyage = $this->voyage->findOrFail($voyageId);

            //cree un nouvel objet 'cart'
            $cart = new CartHelper($request);

            //recupere le tableau de session cart
            $array = session()->get('cart');

            //se déplacer à la fin car la fonction pull de saveTosession, ajoute toujours au dernier index du tableau
            end($array);

            //retourne la clé du tableau "cart' pour savoir a quel index du tableau se situe le nouveau 'cart' ajouter en sessions
            $cle = key( $array );

        }catch (\Exception $exception){
            //si il y a une erreur on renvois fail à la fonction 'ajax'
            return response()->json(['fail' => true, 'message' => $exception->getMessage() ]);
        }

        //sinon on renvois des datas en json à la fonction ajax.
        return response()->json(['success' => true, 'cart' => ['cle' => $cle] ,'voyage' => $voyage, 'numOfVoyage' => count( session()->get('cart'))]);
    }

    /**
     * Supprime un des voyages du panier
     * Repond à un click de l'utilisateur sur le bouton 'deletefromcart'
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeFromCart(Request $request)
    {
        try {
            //Supprime un voyage du tableau 'cart' en session
            CartHelper::deleteVoyageFromCart($request);

        }catch (\Exception $exception){

            //si il y a une erreur on renvois un message d'erreur
            return response()->json(['fail' => true, 'message' => $exception->getMessage() ]);
        }

        //si la maj est ok, on renvois le nouveau nombre de voyage(s) présent(s) dans le tableau "cart'
        return response()->json(['success' => true, 'numOfVoyage' => count(session()->get('cart')) ]);
    }

    /**
     * Response à la Mise à jour de la quantité d'un voyage par l'utilisateur
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateQuantity(Request $request)
    {
        try{
            //on essaye d'updater la quantité du nombre de voyageur d'un des voyages du panier
            CartHelper::updateQuantity($request);

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
