<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    // Manage Users
    public function manage() {
        // return view('roles.admin.manage-users', ['users' => request()->user()->get()]);
        return view('roles.admin.manage-users', ['users' => User::all()]);
    }

    // Edit User Role
    // public function edit() {
    //     return view('', ['users' => request()->user()->get()]);
    // }
}
