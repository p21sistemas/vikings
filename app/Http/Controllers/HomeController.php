<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cartorio;

class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $cartorios = Cartorio::all();
        return view('home', compact('cartorios'));
    }

}
