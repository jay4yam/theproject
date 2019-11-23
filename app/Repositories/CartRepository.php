<?php
/**
 * Created by PhpStorm.
 * User: jayben
 * Date: 08/11/2018
 * Time: 08:33
 */

namespace App\Repositories;

use App\Mail\StripeError;
use App\Models\ItemOrder;
use App\Models\MainOrder;
use App\Models\Profile;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Ramsey\Uuid\Uuid;
use Stripe\ApiResource;
use Stripe\Charge;
use Stripe\Customer;
use Throwable;

class CartRepository
{
    /**
     * @param Request $request
     * @return ApiResource
     * @throws
     */
    public function createStripeCustomer(Request $request)
    {
        try {
            $token = $request->stripeToken;
            $customer = Customer::create([
                'email' => $request->email,
                'source' => $token
            ]);

            return $customer;

        }catch (\Exception $e){
            //log l'erreur
            Log::error($e->getMessage());
            //envoie un email pour signaler erreur
            Mail::to('jay.ayamee@gmail.com')->queue( new StripeError( $e->getMessage() ) );

            throw new \Exception('Erreur de création stripe customer');
        }
    }

    /**
     * @param $stripeCustomer
     * @param  Request  $request
     * @return Builder|Model|object|null
     * @throws Throwable
     */
    public function createEasyCopterCustomer($stripeCustomer, Request $request)
    {
        //1. set une variable user à null
        try {
            $user = null;

            //2. test si un utilisateur est déjà inscrit
            $user = User::where('email', '=', $request->email)->first();

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

            //retourne l'utilisateur trouvé ou crée sur la plateforme
            return $user;

        }catch (\Exception $e){
            //log l'erreur
            Log::error($e->getMessage());
            //envoie un email pour signaler erreur
            Mail::to('jay.ayamee@gmail.com')->sendNow( new StripeError( $e->getMessage() ) );

            throw new \Exception('Erreur de création easyCopter customer');
        }
    }

    /**
     * @param  ApiResource  $customerStripe
     * @param  Request  $request
     * @return mixed
     * @throws \Exception
     */
    public function createChargeOnStripe(ApiResource $customerStripe, Request $request)
    {
        $charge = null;
        try {
            $charge = Charge::create([
                'customer' => $customerStripe->id,
                'amount' => floatval($request->finalPrice * 100),
                'currency' => 'eur',
                'description' => $request->voyage
            ]);

            return $charge;

        }catch (\Exception $e){
            //log l'erreur
            Log::error($e->getMessage());
            //envoie un email pour signaler erreur
            Mail::to('jay.ayamee@gmail.com')->sendNow( new StripeError( $e->getMessage() ) );

            throw new \Exception('Erreur de débit carte bancaire customer');
        }

    }

    /**
     * @param  ApiResource  $customerStripe
     * @param  User  $user
     * @param  ApiResource  $charge
     * @return MainOrder
     * @throws Throwable
     */
    public function createEasyCopterOrder(ApiResource $customerStripe, User $user, ApiResource $charge)
    {
        try {
            //Utilise une transaction pour s'assurer qu'on ai pas la moitié des infos enregistrées
            \DB::transaction(function () use ($customerStripe, $user, $charge, &$mainOrder) {

                //création et insertion de la commande principale
                /*$mainOrder = MainOrder::create([
                    'stripe_customer_id' => $customerStripe->id,
                    'order_id' => Uuid::uuid1()->toString(),
                    'stripe_charge_id' => $charge->id,
                    'stripe_failure_code' => $charge->failure_code,
                    'stripe_failure_message' => $charge->failure_message,
                    'is_paid' => $charge->paid,
                    'stripe_payment_status' => $charge->status,
                ]);
                */

                //Sauv. le main order sur la table correspondante
                $user->mainOrders()->save($mainOrder);

                //Récupère tous les carts en sessions
                //$carts = session()->get('cart');

                //Itère sur les carts
                foreach ($carts as $cart) {
                    //Sauv. le contenu du voyage dans la table itemsOrder
                    $itemOrder = ItemOrder::create([
                        'voyage_id' => $cart->getVoyage()->id,
                        'voyage_name' => $cart->getVoyage()->title,
                        'num_of_passenger' => $cart->getNbVoyageur(),
                        'prix_unitaire' => $cart->getUnitPrice(),
                        'prix_final' => ($cart->getNbVoyageur() * $cart->getUnitPrice()),
                        'date_voyage' => $cart->getDate(),
                    ]);

                    //Lié le mainOrder avec les items
                    $mainOrder->itemsOrder()->save($itemOrder);
                }
            });


        }catch (\Exception $e){
            //log l'erreur
            Log::error($e->getMessage());
            //envoie un email pour signaler erreur
            Mail::to('jay.ayamee@gmail.com')->sendNow( new StripeError( $e->getMessage() ) );

            throw new \Exception('Erreur de débit carte bancaire customer');
        }

        //supprime les items en session
        session()->forget('cart');

        //Retourne la nouvelle transaction
        return $mainOrder;
    }
}