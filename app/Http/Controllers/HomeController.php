<?php

namespace App\Http\Controllers;

use App\DatosTienda;
use Illuminate\Http\Request;
use App\Http\Requests\DatosTiendaFormRequest;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index( Request $request)
    {
        $tiendas = DatosTienda::all();
        return view('home',  ["tiendas"=>$tiendas]);
    }

   
}
