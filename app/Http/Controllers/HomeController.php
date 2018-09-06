<?php

namespace App\Http\Controllers;

use App\User;


class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::get();
        
        return view('home', ['users' => $users]);
    }
}
