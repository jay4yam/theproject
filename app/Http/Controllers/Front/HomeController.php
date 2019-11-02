<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Response;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Show the application front office index.
     *
     * @return Response
     */
    public function index()
    {
        return view('index');
    }

    /**
     * Affiche la page contact
     * @return Factory|View
     */
    public function contact()
    {
        return view('contact');
    }
}
