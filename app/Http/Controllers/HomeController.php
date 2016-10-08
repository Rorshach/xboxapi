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
        //Validate input
        $this->validate($request, [
            'message' => 'required|min:1|filled|max:250',
            'game' => 'required|array'
        ]);
        //Message received
        $msg = $request->input('message');
        //List of games
        $log = $request->input('game');
        //Boolean check for friends
        $friends_Bool = $request->input('friends');
        //Boolean check for Already in conversations
        $convo_Bool = $request->input('convo');

        //Get Recent players + api
        $api = decrypt(\Auth::user()->profile()->first()->api);
        $players = $this->retrieveUsers($api, $log,$friends_Bool,$convo_Bool);

        //Send message to Recent players
        //$playerCount = $this->sendMessage($api, $msg, $players);


        //return redirect('/home');
    }

    /**
    *
    * Filters out useless users from Recent players
    *
    * $api - Users's api key
    * $log(array) - List of Games
    * $friends(bool) - Whether to filter out friends or Not
    * $convo(bool) - Whether to filter out recently msged people
    *
    * Return amount of messages sent.
    */
    public function retrieveUsers($api, $log, $friends, $convo) {

        $finalPlayers = array();
        $recentPlayers = call_API($api, 'recent-players');

        //Push matching game players into array
        foreach($log as $game) {
            foreach($recentPlayers as $player) {
                if ($player['titles'][0]['titleName'] == $game)
                    array_push($finalPlayers , $player['xuid']);
            }
        }

        //Did they set friends?
        if (isset($friends)) {
            $xuid = \Auth::user()->profile()->first()->xuid;
            $friendsJSON = call_API($api,$xuid."/friends");
            $friendsID = array_column($friendsJSON, 'id');
            $finalPlayers = array_diff($finalPlayers,$friendsID);
        }
        var_dump($finalPlayers);

        if (isset($convo)) {
            $convo_JSON = call_API($api,"conversations");
            $convoID = array_column($convo_JSON, 'senderXuid');
            $finalPlayers = array_diff($finalPlayers,$convoID);
        }
        
        return $finalPlayers;
    }

    /**
    *
    *Send Message to Players through Xbox live
    *
    */
    public function sendMessage($api, $msg, $players) {

        $count = 0;
        $playerLimit = array();
        foreach($players as $p) {
            //Put player into playerLimit
                //Count playerLimit Array

        }
    }
}
