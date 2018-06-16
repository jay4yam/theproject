<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function showStep1()
    {
        $carts = session()->get('cart');

        return view('cart.step1', compact('carts'));
    }
}
