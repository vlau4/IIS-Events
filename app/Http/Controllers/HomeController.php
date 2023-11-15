<?php

namespace App\Http\Controllers;

use App\Models\Event;
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
        return view('roles/user/index', [
            'events' => Event::latest()->filter(request(['tag', 'search']))->paginate(6)
        ]);
    }

    public function managerHome()
    {
        return view('roles/manager/index', [
            'events' => Event::latest()->filter(request(['tag', 'search']))->paginate(6)
        ]);
    }

    public function adminHome()
    {
        return view('roles/admin/index', [
            'events' => Event::latest()->filter(request(['tag', 'search']))->paginate(6)
        ]);
    }
}
