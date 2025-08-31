<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{

    function index(){
        $users = User::all();
        return view('usuarios.index', compact('users'));
    }
}
