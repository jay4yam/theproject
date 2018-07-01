<?php

namespace App\Http\Controllers\Front;

use App\Mail\NewsletterSubscribe;
use App\Models\CouponCode;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        //1. vérifier que le mail n'existe pas déjà
        $request->validate([
            'email' => ['unique:newsletter,email']
        ]);

        //2. inscrire le mail dans la table newsletter
        $email = Newsletter::create(['email' => $request->email]);

        //3. créer un coupon de -5% si le mail n'est pas en base
        $coupon = CouponCode::create(['couponCode' => str_random('6'), 'value' => '5.00','email' => $email->email]);

        //4. envoyer un email à l'utilisateur
        \Mail::to($email->email)->send(new NewsletterSubscribe($email, $coupon));

        //3. renvoyer un message pour modifier affichage
        return redirect()->back();
    }
}
