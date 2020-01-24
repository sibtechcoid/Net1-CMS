<?php

namespace App\Http\Controllers\Api;

use App\ApiModels\Product;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{

    // /**
    // * Method to get all products including their zone prices
    // **/
    // public function index() {
    //     $product = new Product;
    //     $response['products'] = $product
    //     ->leftJoin('product_types', 'product_type_id', '=', 'product_types.id')
    //     ->with('zonePrices')
    //     ->select(['products.*', 'product_types.product_type', ])
    //     ->get();
    //     $response['code'] = 200;
    //     return response()->json($response);
    // }

    // /**
    // * Method to get specific product with the zone prices
    // **/
    // public function show(Product $product) {
    //     $response['product'] = $product
    //     ->leftJoin('product_types', 'product_type_id', '=', 'product_types.id')
    //     ->with('zonePrices')
    //     ->select(['products.*', 'product_type'])
    //     ->where('products.id', '=', $product->id)->first();
    //     $response['code'] = 200;
    //     return response()->json($response);
    // }

    // /**
    // * Method to create new product only without the zone prices
    // **/
    // public function store(Request $request) {
    //     // return response()->json($request->insert_type);
    //     $request->validate([
    //         'insert_type' => 'required|regex:/^[a-zA-Z]+$/u'
    //     ]);
    //     $response = [];
    //     if($request->insert_type=='insert') {
    //         return $this->insertProduct($request, $response);
    //     }
    //     else if($request->insert_type==='upload') {
    //         $this->insertProductExcelUpload($request, $response);
    //     }
    //     return response()->json($response);
    // }

    // public function update(Request $request, Product $product) 
    // {
    //     $request->validate([
    //         'plan' => 'required|regex:/^[a-zA-Z]+$/u|min:1',
    //         'product_type_id' => 'required|numeric|min:1',
    //         'product_name' => 'required',
    //         'product_speed' => 'required|min:1',
    //         'product_description' => 'required|min:3',
    //         'product_expiry_in_days' => 'required|numeric',
    //         'publish' => 'required|boolean'
    //     ]);
    //     try {
    //         // Update the product
    //         // $data = $request->except(['_token', 'id']); // get all request variable, empty value filtered
    //         // $filtered_data = array_filter($data);
    //         // $product->fill($filtered_data);
    //         $product->plan = $request->plan;
    //         $product->product_type_id = $request->product_type_id;
    //         $product->product_name = $product->product_name;
    //         $product->product_speed = $request->product_speed;
    //         $product->product_description = $request->product_description;
    //         $product->product_expiry_in_days = $request->product_expiry_in_days;
    //         $product->publish = $request->publish;
    //         $product->save();

    //         $response['message'] = 'Product is updated.';
    //         $response['code'] = 200;
    //     }
    //     catch (\Exception $e) {
    //         $custom_error = ValidationException::withMessages([
    //            'internal_server' => ['Failed to update product. Try again in a few moment.'],
    //         ]);
    //         $response['message'] = $custom_error->getMessage();
    //         $response['errors'] = $custom_error->errors();
    //         $response['code'] = 500;
    //     }
    //     return response()->json($response);
    // }

    // public function activate(Product $product)
    // {
    //     $product->publish = true;
    //     $product->save();

    //     $response['message'] = 'Product is activated/published and available to be viewed publicly.';
    //     $response['code'] = 200;
    //     return response()->json($response);
    // }

    // public function deactivate(Product $product)
    // {
    //     $product->publish = false;
    //     $product->save();

    //     $response['message'] = 'Product is deactivated/unpublished.';
    //     $response['code'] = 200;
    //     return response()->json($response);
    // }

    // private function getPlans()
    // {
    //     $plans = \DB::select( "SHOW COLUMNS FROM products WHERE Field = 'plan'" )[0]->Type;
    //     preg_match("/^enum\(\'(.*)\'\)$/", $plans, $matches);
    //     $enum_plans = explode("','", $matches[1]);
    //     return $enum_plans;
    // }

    // private function isProductExist($product_name)
    // {
    //     // Check if product name exists
    //     return \DB::table('products')
    //     ->whereRaw("
    //         replace(products.product_name, ' ', '') = '". 
    //         str_replace(' ', '', $product_name)."'")->first();
    // }

    // private function insertProduct($request, $response)
    // {
    //     // var_dump($request->all());
    //     // var_dump($request->zone_prices[0]);exit;
    //     $request->validate([
    //         'plan' => 'required|regex:/^[a-zA-Z]+$/u',
    //         'product_type_id' => 'required',
    //         'product_name' => 'required|unique:products|min:3',
    //         'product_speed' => 'required',
    //         'product_description' => 'required',
    //         'product_expiry_in_days' => 'required|numeric',
    //         'zone_price_status' => 'required|boolean'
    //     ]);
    //     $product = $this->isProductExist($request->product_name);
    //     if($product) {
    //         $custom_error = ValidationException::withMessages([
    //            'product_name' => ['Product is exist. Please choose another product name.'],
    //         ]);
    //         $response['message'] = $custom_error->getMessage();
    //         $response['errors'] = $custom_error->errors();
    //         $response['code'] = 422;
    //         return response($response);
    //     }
    //     try {
    //         // var_dump($request->getContent());exit;
    //         $product = new Product;
    //         $product->plan = $request->plan;
    //         $product->product_type_id = $request->product_type_id;
    //         $product->product_name = $request->product_name;
    //         $product->product_speed = str_replace(' ', '', $request->product_speed);
    //         $product->product_description = $request->product_description;
    //         $product->product_expiry_in_days = $request->product_expiry_in_days;
    //         $product->publish = false;
    //         $product->zone_price_status = $request->zone_price_status;

    //         $product->save();
    //         // Check if there is any zone prices, then insert
    //         if($request->zone_price_status == true || $request->zone_price_status == 'true') {
    //             if($request->zone_prices[0] != '' ) {
    //                 // echo $request->zone_prices[0]['zone_id'];exit;
    //                 // Remove whitespaces on zone_id string
    //                 $zone_prices = $request->zone_prices;
    //                 // var_dump($zone_prices);exit;
    //                 for($i=0; $i < count($zone_prices); $i++) {
    //                     // echo $zone_prices[$i]['zone_id'];exit;
    //                     $zone_prices[$i]['zone_id'] = strtoupper(preg_replace('/\s+/', '', $zone_prices[$i]['zone_id']));
    //                     $zone_prices[$i]['product_id'] = $product->id;
    //                     $zone_prices[$i]['created_at'] = $product->created_at;
    //                     $zone_prices[$i]['updated_at'] = $product->updated_at;
                        
    //                 }
    //                 // Remove array with duplicate zone_id
    //                 $unique_zone_prices = array_unique(array_column($zone_prices , 'zone_id'));
    //                 $zone_prices = array_intersect_key($zone_prices , $unique_zone_prices);
    //                 // var_dump($zone_prices);exit;
    //                 // Insert into zone_prices table
    //                 $insert_zone_price = \DB::table('zone_prices')->insert($zone_prices);
    //                 $response['message'] = 'New Product added.';
    //                 $response['code'] = 200;

    //                 return response()->json($response);
    //             }
    //         }
    //         else if($request->zone_price_status == false || $request->zone_price_status == 'false') {
    //             if($request->product_price != '' || $request->product_price != null || $request->product_price != 0) {
    //                 $product->product_price = $request->product_price;
    //                 $product->save();

    //                 $response['message'] = 'New Product added.';
    //                 $response['code'] = 200;

    //                 return response()->json($response);
    //             }
    //             else {
    //                 $custom_error = ValidationException::withMessages([
    //                    'product_name' => ['Product price is zero. Please fill the value of product price.'],
    //                 ]);
    //                 $response['message'] = $custom_error->getMessage();
    //                 $response['errors'] = $custom_error->errors();
    //                 $response['code'] = 422;
    //                 return response($response);
    //             }
    //         }
            
    //     }
    //     catch (\Exception $e) {
    //         echo $e;exit;
    //         $custom_error = ValidationException::withMessages([
    //            'internal_server' => ['Failed to add new product. Try again in a few moment.'],
    //         ]);
    //         $response['message'] = $custom_error->getMessage();
    //         $response['errors'] = $custom_error->errors();
    //         $response['code'] = 500;
    //         return response()->json($response);
    //     }
    // }

    // private function insertProductExcelUpload($request, $response)
    // {

    // }
}

