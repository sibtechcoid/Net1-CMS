<?php


namespace App\Http\Controllers\Api;

use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\ApiModels\ProductNetOneMobile;

class ProductNetOneMobileController extends Controller
{
    //
    public function products(){
        $product= ProductNetOneMobile::all();
        $send = json_decode($product,true);
        return $send;

    }


}
