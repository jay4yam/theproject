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

    protected $cartKey;
    public function getCartKey(){
        return $this->cartKey;
    }

    /**
     * @param  Request  $request
     * @param  Voyage  $voyage
     */
    public function save(Request $request, Voyage $voyage)
    {
        $this->voyage = $voyage;

        $this->nbVoyageur = $request->numOfVoyagers;

        $this->date = $request->dateDeDepart;

        $this->prixUnitaire = $request->individualPrice;

        $this->userIp = \Request::ip();

        $this->finalPrice = self::calculateFinalePrice($request->numOfVoyagers, $request->individualPrice);

        $this->cartKey = self::setKey();

        $this->saveToSession();
    }

    /**
     * retourne l'index à laquelle se trouve le nouveau produit ajouter au panier et sauv. en session
     * @return int
     */
    private function setKey(){

        return session()->get('cart') ? count(session()->get('cart')) : 0;
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
    private function saveToSession()
    {
        session()->push('cart', $this);
    }

    /**
     * Supprime un voyage du panier
     * @param Request $request
     * @throws \Exception
     */
    public function deleteVoyageFromCart(Request $request)
    {
        //supprime l'indice du tableau 'cart' qui contient le voyage que l'on veut supprimer
        session()->pull('cart.'.$request->indexArrayofSessionCart);
    }

    /**
     * @param Request $request
     * @throws \Exception
     */
    public function updateQuantity(Request $request)
    {
        try {
            //recupere le tableau 'cart' en session
            $cartArray = session()->get('cart');

            //supprime le 'cart' du panier
            session()->pull('cart.' . $request->sessionArray);

            //récupère le cart en fonction de la clé
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