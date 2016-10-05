<?php

namespace App\Http\Controllers;

use App\Profile;
use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Grab api + Decrypt it
        $encryptedAPI = \Auth::user()->profile()->first()->api;
        $uniqueGames = array();
        if(isset($encryptedAPI)) {
            $api = decrypt($encryptedAPI);

            //Grab List of Games - played by user
            $recent_JSON = call_API($api,"recent-players");
            $uniqueGames = array_unique(array_map(function ($i) { return $i['titles'][0]['titleName']; }, $recent_JSON));

            //$friends_JSON = call_API($api,$xuid['userXuid']."/friends");
            //$convo_JSON = call_API($api,"conversations");

            //PUT HERE AFTER YOU SAVE
            \Session::flash('flash_message',"1. Write Message // 2. Choose Players // 3. Filter Out Players // 4. SEND");
        }
        return view('home',['uniqueGames' => $uniqueGames]);
    }

    /**
     * Send Message to Recent Players
     *
     *
     */
    public function post(Request $request)
    {
        //Message received
        $msg = $request->input('message');
        //List of games
        $listOfGames = $request->input('game');
        //Boolean check for friends
        $friends_Bool = $request->input('friends');
        //Boolean check for Already in conversations
        $convo_Bool = $request->input('convo');

        var_dump($msg);
        var_dump($listOfGames);
        var_dump($friends_Bool);
        var_dump($convo_Bool);

        return view('home');
    }

    public function retrieveUsers($game, $friends, $convo) {
        //Grab api + Decrypt it
        $api = decrypt(\Auth::user()->profile()->api);

    }
}
