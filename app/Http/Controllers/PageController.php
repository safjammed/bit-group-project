<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class PageController extends Controller
{
    //
    public function manageUsers(){
        return view("pages.manageUsers",[
            "users" => User::all(),
            "roles" => Role::all()
        ]);
    }
}
