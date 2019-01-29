<?php

namespace App\Http\Controllers\Back;

use App\Models\MainOrder;
use App\Repositories\OrderRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    protected $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * Affiche la home page de l'admin
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $mainOrders = $this->orderRepository->getAll();

        return view('back.index', compact('mainOrders'));
    }

}
