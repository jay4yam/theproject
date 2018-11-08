<?php

namespace App\Http\Controllers\Front;

use App\Http\Requests\ChargeRequest;
use App\Models\ItemOrder;
use App\Models\MainOrder;
use App\Models\Order;
use App\Models\Profile;
use App\Models\User;
use App\Models\Customer as easyCopterUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use Ramsey\Uuid\Uuid;
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

        return view('cart.step1', compact('carts'));
    }

    /**
     * Gère le click sur le bouton validation paiement
     * @param ChargeRequest $request
     * @return \Illuminate\Http\RedirectResponse|string
     */
    public function charge(ChargeRequest $request)
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
            $order = $this->createOrder($customerStripe, $user, $charge);

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
        \DB::transaction(function () use ($stripeCustomer, $request, &$user){

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
     * @param ApiResource $customerStripe
     * @param User $user
     * @param ApiResource $charge
     * @param Request $request
     */
    private function createOrder(ApiResource $customerStripe, User $user, ApiResource $charge)
    {
        //Utilise une transaction pour s'assurer qu'on ai pas la moitié des infos enregistrées
        \DB::transaction(function () use($customerStripe, $user, $charge) {

            //création et insertion de la commande principale
            $mainOrder = MainOrder::make([
                'stripe_customer_id' => $customerStripe->id,
                'order_id' => Uuid::uuid1(),
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
    }
}
