<?php
use GuzzleHttp\Client;
    /**
    * Call to API
    *
    *
    */
    function call_API($api,$url) {
        if(strlen($api) < 40) {
            return NULL;
        }
        try {
            $client = new GuzzleHttp\Client(['headers' => ['X-AUTH' => $api]]);
            $url_call = "https://xboxapi.com/v2/".$url;

            $res = $client->get($url_call,['http_errors' => false]);
        } catch (Exception $e) {
             return redirect('/user')->withErrors(['Error with API Key, Try resubmitting the key']);;
        }

        $response_string = $res->getBody()->getContents();
        return json_decode($response_string, true);

    }

    /**
    *   Send Message to players
    *
    *   $api - api key
    *   $players - array of player id
    *   $msg - String msg
    */
    function send_Message($api, $players, $msg) {
        if(empty($players) || empty($msg) )  {
            return;
        }

        try {
            $client = new GuzzleHttp\Client(['headers' => ['X-AUTH' => $api] ,
                                            'Content-Type' => 'application/json' ]);
            $url = "https://xboxapi.com/v2/messages";

            $postData = array("to"=> $players,
		                      "message"=> $msg);
            $postData_JSON = json_encode($postData);

            $res = $client->post($url,['body' => $postData_JSON,'http_errors' => false]);

        } catch (Exception $e) {
            return redirect('/')->withErrors(['Error with Sending Message, Try again']);;
        }

        $response_string = $res->getBody()->getContents();
        return json_decode($response_string, true);

    }
 ?>
