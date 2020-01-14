<?php

namespace App\Models\Admin;

use App\Helpers\Curl;
use App\Helpers\ApiUrl;
use Illuminate\Support\Facades\Cookie;

class Banner
{
    private $curl;

    public function __construct()
    {
        $this->curl = new Curl();
        $this->curl->setAccessToken(Cookie::get('authToken'));
    }

    public function getAllBanners()
    {
        $response = $this->curl->httpGet(ApiUrl::$url.'banners');
        $response = json_decode($response, true);

        return $response;
    }

    public function getBanner($id)
    {
        $response = $this->curl->httpGet(ApiUrl::$url.'banners/'.$id);
        $response = json_decode($response, true);

        return $response;
    }

    public static function getBannerPicture($id)
    {
//        $curl = new Curl();
//        $curl->setAccessToken(Cookie::get('authToken'));
//        $response = $curl->httpGet(ApiUrl::$url.'getDisplayBanner/'.$id);
////        $response = json_decode($response, true);
//
//        return $response;
        return ApiUrl::$url.'getDisplayBanner/'.$id;
    }

    public function addBanner($fields)
    {
        $response = $this->curl->httpPost(ApiUrl::$url.'banners', $fields);
        $response = json_decode($response, true);

        return $response;
    }


}
