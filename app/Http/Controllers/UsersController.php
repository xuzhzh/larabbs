<?php

namespace App\Http\Controllers;

use App\Models\User;

class UsersController extends Controller
{

    //index show create store edit update destory
    public function show(User $user)
    {
       return view('users.show',compact('user',compact('user')));
    }
}
