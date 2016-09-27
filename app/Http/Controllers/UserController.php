<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

    /**
     * Create a new controller instance.
     * Prevents guests from viewing this page
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Show API details of given user.
     *
     *
     */
    public function show()
    {
        $id = Auth::user()->id;
        return view('user',['api_key'=>User::name]);
    }
}
