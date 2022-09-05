<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
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
       //raw php
       // $select_query ="SELECT * FROM users";

       //Laravel Code
       $users = User::latest()->paginate(5);
       $total_users = user::count();
       // 1 Compact
        return view('home', compact('users', 'total_users'));
        // 2 Array
        // return view('home', [
        //   'users' => $users,
        //   'total_users' => $total_users
        // ]);
        // 3 With
        // return view('home')->with('users', $users)->with('total_users', $total_users);
    }
}
