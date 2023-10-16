<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use App\Models\Round;
use Illuminate\Http\Request;

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
    public function index()
    {
        $competitions = Competition::all();
        return view('home', ['competitions' => $competitions]);
    }
}
