<?php

namespace App\Http\Controllers\Ajax;

use App\Repositories\OrderRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommandeController extends Controller
{
    /**
     * @var OrderRepository
     */
    protected $orderRepository;

    /**
     * CommandeController constructor.
     * @param OrderRepository $orderRepository
     */
    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function ajaxGetItemsOrderInfo(Request $request)
    {
        //1. recupère le mainOrder
        $mainOrder = $this->orderRepository->getById($request->id);

        //2. retourne la liste des items voyages appartenant au mainOrder identifié.
        return $itemsOrder = $this->orderRepository->getItemsOrder($mainOrder);
    }
}
