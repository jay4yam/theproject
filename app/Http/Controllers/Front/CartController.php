<?php

namespace App\Http\Controllers\Front;

use App\Http\Requests\ChargeRequest;

use App\Http\Controllers\Controller;
use App\Mail\mainOrderMailable;
use App\Models\MainOrder;
use App\Repositories\CartRepository;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Stripe\Stripe;

class CartController extends Controller
{
    /**
     * @var CartRepository
     */
    protected $cartRepository;

    /**
     * CartController constructor.
     * @param CartRepository $cartRepository
     */
    public function __construct(CartRepository $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    /**
     * Affiche la premiere étape du panier
     * @return Factory|View
     */
    public function showCart()
    {
        $carts = session()->get('cart');

        return view('cart.step1', compact('carts'));
    }

    /**
     * Gère le click sur le bouton validation paiement
     * @param  ChargeRequest  $request
     * @return RedirectResponse|string
     * @throws \Throwable
     */
    public function charge(ChargeRequest $request)
    {
        Stripe::setApiKey('sk_test_2H3k1N7NOdjh4oA76TvqRRTa');

        try {
            //Crée un customer stripe
            $customerStripe = $this->cartRepository->createStripeCustomer($request);

            //Crée un customer easyCopter
            $user = $this->cartRepository->createEasyCopterCustomer($customerStripe, $request);

            //Requête vers l'api Stripe pour charger la carte de l'utilisateur
            $charge = $this->cartRepository->createChargeOnStripe($customerStripe, $request);

            //Enregistre la commande dans la table commande
            $order = $this->cartRepository->createEasyCopterOrder($customerStripe, $user, $charge);

        }catch (\Exception $exception){
            flash()->error( $exception->getMessage());
            return back()->withInput();
        }
        return redirect()->to(\App::getLocale().'/thank/'.$order->order_id);
    }

    /**
     * Page de remerciement
     * @param $locale
     * @param $orderId
     * @return Factory|View
     */
    public function thank($locale, $orderId)
    {
        $mainOrder = MainOrder::with('itemsOrder', 'user')->where('order_id', '=', $orderId)->first();

        $qrCode = 'order_id :'.$mainOrder->order_id.'\n';
        $qrCode .= 'Customer name:'.$mainOrder->user->profile->fullName.'\n';
        $qrCode .= 'Customer firstName:'.$mainOrder->user->profile->firstName.'\n';
        $qrCode .= 'Customer Email:'.$mainOrder->user->email.'\n';

        return view('cart.thank', compact('mainOrder', 'qrCode'));
    }
}
