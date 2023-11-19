<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    // Manage Users
    public function manage() {
        // return view('roles.admin.manage-users', ['users' => request()->user()->get()]);
        $role = 'User';
        return view('roles.admin.manage-users', ['users' => User::all()]);
    }

    // Change User Role
    public function change(Request $request, User $user) {

        //the validation is not neccessery
        User::where('id', $user->id)->update([
            'role' => $request->role
        ]);

        return redirect('/users')->with('message', 'The role was successfully changed!');
    }

    // Edit User Role
    // public function edit() {
    //     return view('', ['users' => request()->user()->get()]);
    // }
}
