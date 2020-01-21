<?php

namespace App\Models;

use App\Helpers\Curl;
use App\Helpers\ApiUrl;
use Illuminate\Support\Facades\Cookie;

class User_Backup
{
    private $curl;

    public function __construct()
    {
        $this->curl = new Curl();
        $this->curl->setAccessToken(Cookie::get('authToken'));
    }

    public function getAllUsers()
    {
        $response = $this->curl->httpGet(ApiUrl::$url.'users');
        $response = json_decode($response, true);

        return $response;
    }

    public function addUser($fields)
    {
        $response = $this->curl->httpPost(ApiUrl::$url.'users', $fields);
        $response = json_decode($response, true);

        return $response;
    }

    public static function getSlightInfo() {
        if(Cookie::get('authToken')!=null) {
            $curl = new Curl();
            $curl->setAccessToken(Cookie::get('authToken'));
            $response = $curl->httpGet(ApiUrl::$url.'currentUserSlightInfo');
            $response = json_decode($response, true);
            return $response;
        }
    }
}
