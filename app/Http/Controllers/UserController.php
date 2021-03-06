<?php

namespace App\Http\Controllers;

use App\User;
use App\Profile;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;

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
        //Grab encrypted API
        $encrypted_api = \Auth::user()->profile()->first()->api;

        //If API is filled in DB
        if ($encrypted_api != NULL) {
            try{
                //Decrypted API + grab JSON with API
                $decrypted_api = decrypt($encrypted_api);
                $apiRes = call_API($decrypted_api,"profile");

                //Check if currently stored API Key is still working
                if(isset($apiRes['error_code'])) {
                    return view('user')->withErrors([$apiRes['error_message']]);
                }

                //Return view with gamerTag
                return view('user',['gamerTag'=> $apiRes['gamerTag']]);

            } catch (DecryptException $e) {
                return view('user')->withErrors(['Error Retrieving API Key, Try again or Try resubmitting the key']);
            }
        } else {

            return view('user');
        }


    }

    /**
     * Update New API into user table
     *
     *
     */
    public function post(Request $request)
    {
        //Validate input
        $this->validate($request, [
            'api_key' => 'required|min:40|filled|correctapi',
        ]);

        //Strip out white space
        $api = $request->input('api_key');
        $api = str_replace(' ', '', $api);

        //Grab Profile Information
        $profile_JSON = call_API($api,'profile');
        $gamertag = $profile_JSON['gamerTag'];//GT
        $xuid = $profile_JSON['userXuid']; //XUID
        //Encrypt API key
        $Encr_api = encrypt($api);

        //Store new information
        $profile = \Auth::user()->profile()->first();
        $profile->api = $Encr_api; //Encrypted API Key
        $profile->gamertag =$gamertag;
        $profile->xuid = $xuid;

        $profile->save();
        return redirect('/user');
    }
}
