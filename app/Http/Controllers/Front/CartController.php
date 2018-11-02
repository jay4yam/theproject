<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Stripe\Charge;
use Stripe\Stripe;

class CartController extends Controller
{
    /**
     * Affiche la premiere étape du panier
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showStep1()
    {
        $carts = session()->get('cart');

        return view('cart.step1', compact('carts'));
    }

    public function charge(Request $request)
    {
        try {
            Stripe::setApiKey('sk_test_2H3k1N7NOdjh4oA76TvqRRTa');

            $token = $request->stripeToken;

            $charge = Charge::create([
                'amount' => $request->finalPrice,
                'currency' => 'eur',
                'description' => $request->voyage,
                'source' => $token,
            ]);
        }catch (\Exception $exception){
            return back()->with('message', $exception->getMessage());
        }
        return back()->with('message', 'Paiement accepté');
    }
}
