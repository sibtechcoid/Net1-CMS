<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class productlistmobileController extends Controller
{
    //productlist mobile
    public function index(){
        $product= productlistmobile::all();
        $send = json_decode($product,true);
        return $send;

    }
}
