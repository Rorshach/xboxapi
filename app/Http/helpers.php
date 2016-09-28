<?php
use GuzzleHttp\Client;
    /**
    * Call to API
    *
    *
    */
    function helper($api,$url) {
        if($api == NULL) {
            return NULL;
        }
        $client = new GuzzleHttp\Client(['headers' => ['X-AUTH' => $api]]);
        $url_call = "https://xboxapi.com/v2/".$url;

        //$client->setDefaultOption('headers', ['X-AUTH' => $api]);
        //$res = $client->request('GET', $url_call);
        $res = $client->get($url_call);

        $response_string = $res->getBody()->getContents();
        return json_decode($response_string, true);
    }



 ?>
