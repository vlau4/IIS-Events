<?php

namespace App\Http\Controllers;

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
        //
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function userHome()
    {
        return view('home', ['msg'=>'I am user!']);
    }

    public function managerHome()
    {
        return view('home', ['msg'=>'I am manager!']);
    }

    public function adminHome()
    {
        return view('home', ['msg'=>'I am admin!']);
    }
}
