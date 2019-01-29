<?php
/**
 * Created by PhpStorm.
 * User: jayben
 * Date: 08/11/2018
 * Time: 08:33
 */

namespace App\Repositories;

use App\Models\ItemOrder;
use App\Models\MainOrder;
use App\Models\Profile;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Stripe\ApiResource;
use Stripe\Charge;
use Stripe\Customer;

class CartRepository
{
    /**
     * @param Request $request
     * @return \Stripe\ApiResource
     */
    public function createStripeCustomer(Request $request)
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
    public function createEasyCopterCustomer($stripeCustomer, Request $request)
    {
        $user = null;
        //1. recupère le mail
        $mail = $request->email;
        $user = User::where('email', '=', $mail)->first();

        if (!$user) {
            \DB::transaction(function () use ($stripeCustomer, $request, &$user) {

                //Tentative de création d'un utilisateur
                $user = User::create([
                    'email' => $request->email,
                    'password' => bcrypt(str_random(10)),
                    'role' => 'guest'
                ]);

                //Tentative de création du profile d'un utilisateur
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

                //Sauv. le user et son profil
                $user->profile()->save($profile);
            });
        }

        //retourne l'utilisateur
        return $user;
    }

    /**
     * @param \Stripe\ApiResource $customerStripe
     * @param Request $request
     * @return \Stripe\ApiResource
     */
    public function createChargeOnStripe(ApiResource $customerStripe, Request $request)
    {
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
     * @param ApiResource $customerStripe
     * @param User $user
     * @param ApiResource $charge
     * @return MainOrder
     */
    public function createEasyCopterOrder(ApiResource $customerStripe, User $user, ApiResource $charge)
    {
        //Utilise une transaction pour s'assurer qu'on ai pas la moitié des infos enregistrées
        \DB::transaction(function () use($customerStripe, $user, $charge, &$mainOrder) {

            //création et insertion de la commande principale
            $mainOrder = MainOrder::make([
                'stripe_customer_id' => $customerStripe->id,
                'order_id' => Uuid::uuid1()->toString(),
                'stripe_charge_id' => $charge->id,
                'stripe_failure_code' => $charge->failure_code,
                'stripe_failure_message' => $charge->failure_message,
                'is_paid' => $charge->paid,
                'stripe_payment_status' => $charge->status,
            ]);

            //Sauv. le main order sur la table correspondante
            $user->mainOrders()->save($mainOrder);

            //Récupère tous les carts en sessions
            $carts = session()->get('cart');

            //Itère sur les carts
            foreach ($carts as $cart)
            {
                //Sauv. le contenu du voyage dans la table itemsOrder
                $itemOrder = ItemOrder::make([
                    'voyage_id' => $cart->getVoyage()->id,
                    'voyage_name' => $cart->getVoyage()->title,
                    'num_of_passenger' => $cart->getNbVoyageur(),
                    'prix_unitaire' => $cart->getUnitPrice(),
                    'prix_final' => ($cart->getNbVoyageur() * $cart->getUnitPrice() ),
                    'date_voyage' => $cart->getDate(),
                ]);

                //Lié le mainOrder avec les items
                $mainOrder->itemsOrder()->save($itemOrder);
            }
        });

        return $mainOrder;
    }
}