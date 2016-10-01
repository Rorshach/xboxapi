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
    *   Check if API Key is valid
    *
    *
    */
    function check_API($api) {
        if(strlen($api) < 40) {
            return false;
        }
        $client = new GuzzleHttp\Client(['headers' => ['X-AUTH' => $api]]);
        $url_call = "https://xboxapi.com/v2/profile";

        if ($client->request('GET',$url_call, ['http_errors' => false])->getStatusCode() != 202)
            return false;
        else
            return true;



    }



 ?>
