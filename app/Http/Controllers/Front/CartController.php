<?php

namespace App\Http\Controllers\Front;

use App\Models\Order;
use App\Models\Profile;
use App\Models\User;
use App\Models\Customer as easyCopterUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use Stripe\ApiResource;
use Stripe\Charge;
use Stripe\Customer;
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

        $value = Cookie::get('cart');

        dd($value);

        return view('cart.step1', compact('carts'));
    }


    public function charge(Request $request)
    {
        Stripe::setApiKey('sk_test_2H3k1N7NOdjh4oA76TvqRRTa');

        try {
            //Crée un customer stripe
            $customerStripe = $this->createStripeCustomer($request);

            //Crée un customer easyCopter
            $user = $this->createEasyCopterCustomer($customerStripe, $request);

            //Requête vers l'api Stripe pour charger la carte de l'utilisateur
            $charge = $this->createChargeOnStripe($customerStripe, $request);

            //Enregistre la commande dans la table commande
            $order = $this->createOrder($user, $charge, $request);

        }catch (\Exception $exception){
            return $exception->getMessage();
        }
        return redirect()->route('cart.thank', compact('order'));
    }

    /**
     * @param Request $request
     * @return \Stripe\ApiResource
     */
    private function createStripeCustomer(Request $request)
    {
        $token = $request->stripeToken;
        try {
            $customer = Customer::create([
                'email' => $request->email,
                'source' => $token
            ]);
        }catch (\Exception $e){
            print('Message :' . $e->getMessage() . "\n");
        }
        return $customer;
    }

    /**
     * @param $stripeCustomer
     * @param Request $request
     * @return $this|\Illuminate\Database\Eloquent\Model
     */
    private function createEasyCopterCustomer($stripeCustomer, Request $request)
    {
        $user = new User();
        \DB::transaction(function () use ($stripeCustomer, $request){

            //Tentative de création d'un utilisateur
            try {
                $user = User::create([
                    'email' => $request->email,
                    'password' => bcrypt(str_random(10)),
                    'role' => 'guest'
                ]);
            }catch (\Exception $exception) {
                print ($exception->getMessage());
            }

            //Tentative de création du profile d'un utilisateur
            try {
                $profile = Profile::make([
                    'firstName' => $request->firstname,
                    'fullName' => $request->name,
                    'phoneNumber' => $request->telephone,
                    'address' => $request->adresse,
                    'birthDate' => Carbon::now(),
                    'postalCode' => $request->code_postal,
                    'city' => $request->ville,
                    'country' => 'default_country'
                ]);

                $user->profile()->save($profile);

            }catch (\Exception $exception) {
                print ($exception->getMessage());
            }

            //Tentative de création d'un Customer
            try {
                $customer = easyCopterUser::make([
                    'stripe_customer_id' => $stripeCustomer->id,
                ]);

                $user->customer()->save($customer);

            }catch (\Exception $exception){
                print ($exception->getMessage());
            }

        });
        return $user;
    }

    /**
     * @param \Stripe\ApiResource $customerStripe
     * @param Request $request
     * @return \Stripe\ApiResource
     */
    private function createChargeOnStripe(ApiResource $customerStripe, Request $request)
    {
        $token = $request->stripeToken;
        try {
            $charge = Charge::create([
                'customer' => $customerStripe->id,
                'amount' => floatval($request->finalPrice * 100),
                'currency' => 'eur',
                'description' => $request->voyage
            ]);
        }catch (\Exception $exception){
            print ($exception->getMessage());
        }
        return $charge;
    }

    /**
     * @param User $user
     * @param ApiResource $charge
     * @param Request $request
     */
    private function createOrder(User $user, ApiResource $charge, Request $request)
    {
        //création et insertion de la commande en ligne
        $order = Order::make([

        ]);

        $user->orders()->save($order);
    }
}
