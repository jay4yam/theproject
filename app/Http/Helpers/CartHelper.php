<?php
/**
 * Created by PhpStorm.
 * User: jayben
 * Date: 07/06/2018
 * Time: 08:42
 */
namespace App\Http\Helpers;

use App\Models\Voyage;
use Illuminate\Http\Request;

class CartHelper
{
    protected $one =1;

    protected $voyage;
    public function getVoyage()
    {
        return $this->voyage;
    }

    protected $nbVoyageur;
    public function getNbVoyageur(){
        return $this->nbVoyageur;
    }

    protected $date;
    public function getDate(){
        return $this->date;
    }

    protected $prixUnitaire;
    public function getUnitPrice(){
        return $this->prixUnitaire;
    }

    protected $userIp;
    public function getUserIp(){
        return $this->userIp;
    }

    protected $finalPrice;
    public function getFinalPrice(){
        return $this->finalPrice;
    }

    /**
     * CartHelper constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->voyage = Voyage::findOrFail($request->voyageId);
        $this->nbVoyageur = $request->numOfVoyagers;
        $this->date = $request->dateDeDepart;
        $this->prixUnitaire = $request->individualPrice;
        $this->userIp = \Request::ip();
        $this->finalPrice = $this->calculateFinalePrice($request->numOfVoyagers, $request->individualPrice);
        $this->saveToSession();
        $this->saveToCookie();
    }

    /**
     * @param int $nbVoyageur
     * @param float $prixUnitaire
     * @return float|int
     */
    private function calculateFinalePrice($nbVoyageur, $prixUnitaire)
    {
        return $nbVoyageur * $prixUnitaire;
    }

    /**
     * Sauv. le panier en session
     */
    public function saveToSession()
    {
        session()->push('cart', $this);
    }

    /**
     * Sauv. Le panier en cookie
     */
    public function saveToCookie()
    {
        try{

            cookie()->make('cart', serialize($this), 3600);

        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    /**
     * Supprime un voyage du panier
     * @param Request $request
     * @throws \Exception
     */
    public static function deleteVoyageFromCart(Request $request)
    {
            //essaye de supprimer l'indice du tableau 'cart' qui contient le voyage que l'on veut supprimer
            session()->pull('cart.'.$request->indexArrayofSessionCart);
    }

    /**
     * @param Request $request
     * @throws \Exception
     */
    public static function updateQuantity(Request $request)
    {
        try {
            //recupere le tableau 'cart' en session
            $cartArray = session()->get('cart');

            //supprime le 'cart' du panier
            session()->pull('cart.' . $request->sessionArray);

            //récupère le cart en fonction de la cleé
            $cart = $cartArray[$request->sessionArray];

            //modifie le nombre de voyageur
            $cart->nbVoyageur = $request->newQuantity;

            //recalcule le montant final
            $cart->finalPrice = $cart->calculateFinalePrice($request->newQuantity, $cart->prixUnitaire);

            session()->push('cart', $cart);

        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

}