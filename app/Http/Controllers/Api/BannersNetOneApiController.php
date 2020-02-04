<?php

namespace App\Http\Controllers\Api;
use App\ApiModels\BannersNetOneApi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BannersNetOneApiController extends Controller
{
    //send data from database to mobile
    public function Index(){
        $banners= BannersNetOneApi::all();
        $send = json_decode($banners,true);
        return $send;

    }

    // public function
}
