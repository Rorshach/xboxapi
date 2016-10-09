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
        $this->middleware('lockout');
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
        //Demo
        $demoPlayers = array('2533274828936345','2535450197037833');
        send_Message($api,$demoPlayers, $msg);
/*
        $subPlayers_1 = array_slice($players, 0, count($players)/2);
        send_Message($api,$subPlayers_1, $msg);
        $subPlayers_2 = array_slice($players, (count($players)/2)+1, count($players));
        send_message($api,$subPlayers_2, $msg);
*/
        \Session::flash('flash_message',"Successfully Sent Message to ".count($players)." players");

        return redirect('lockout');
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

        //Remove recently messaged players?
        if (isset($convo)) {
            $convo_JSON = call_API($api,"conversations");
            $convoID = array_column($convo_JSON, 'senderXuid');
            $finalPlayers = array_diff($finalPlayers,$convoID);
        }

        if(count($finalPlayers) > 60) {
            $finalPlayers = array_slice($finalPlayers, 0, 60);
        }

        return $finalPlayers;
    }
}
