<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductlistController extends Controller
{
    //get api bss
    public function getGuzzleRequest()
    {
    
        $data= [
            'data' => [''],
    ];
        $client = new Client([
            'auth' => [
                'admin',
                 'admin'],
            'header' => [
                'content-type' => 'application/json;charset=UTF-8'],
               
            ]);
        $request = $client->request('POST','http://10.211.1.21:8000/v1/uat/getProductList',[
            'json' => $data,
        ]);
        $response = $request->getBody()->getContents();
       $result = json_decode($response,true);
       return $result;
}
}