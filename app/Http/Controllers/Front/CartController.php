<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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

        dd($request->all());
    }
}
