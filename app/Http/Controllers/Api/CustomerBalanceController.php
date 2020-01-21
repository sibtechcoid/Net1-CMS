<?php

namespace App\Http\Controllers\Api;

use App\ApiModels\CustomerBalance;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerBalanceController extends Controller
{

    public function index()
    {
        $response['customerBalances'] = CustomerBalance::all();
        $response['code'] = 200;
        return response()->json($response);
    }

    public function show(CustomerBalance $customerBalance)
    {
        $response['customerBalance'] = $customerBalance;
        $response['code'] = 200;
        return response()->json($response);
    }

    public function update(Request $request, CustomerBalance $customerBalance)
    {
        // $request->validate([
        //     'product_id' => 'required',
        // ]);

        // $cust_id = auth()->user()->id;
        // $zone_id = 'z1';
        // $zone_id = str_replace(' ', '', $zone_id);
        // $zone_id = strtoupper($zone_id);
        // $product = \DB::table('products')
        // ->leftJoin('product_types', 'products.product_type_id', '=', 'product_types.id')
        // ->leftJoin('zone_prices', 'products.id', '=', 'zone_prices.product_id')
        // ->where('products.id', '=', $request->product_id)
        // ->where('zone_prices.zone_id', '=', $zone_id)
        // ->select('products.id', 'product_type', 'products.product_name','zone_prices.zone_id', 'zone_prices.zone_price')
        // ->first();
        // $product_type = strtolower($product->product_type);
        // $product_type = str_replace(' ', '', $product_type);
        // if($product_type !== 'topup') {
        //     $custom_error = ValidationException::withMessages([
        //         'product_id' => ['The product you requested is not a topup product.'],
        //     ]);
        //     $response['message'] = $custom_error->getMessage();
        //     $response['errors'] = $custom_error->errors();
        //     $response['code'] = 422;
        // }
        // else {
        //     try {
        //         \DB::transaction(function () use ($request, &$response, &$cust_id, &$product, &$remaining_balance) {
        //             $timestamp_now = Carbon::now();
        //             \DB::table('purchase_orders')->insert([
        //                 'customer_id' => $cust_id,
        //                 'product_id' => $product->id,
        //                 'product_name' => $product->product_name,
        //                 'zone_id' => $product->zone_id,
        //                 'status' => 'active',
        //                 'price' => $product->zone_price,
        //                 'purchase_date' => $timestamp_now,
        //                 'created_at' => $timestamp_now,
        //                 'updated_at' => $timestamp_now
        //             ]);
        //             $balance_avail = number_format($customerBalance->balance_available + $product->zone_price);
        //             $customerBalance
        //                 ->where('customer_id', $cust_id)
        //                 ->update([
        //                     'balance_available' => number_format()
        //                 ]);
        //         });
        //         $response['message'] = 'Transaction has done successfully.';
        //         $response['code'] = 200;
        //     }
        //     catch(\Exception $e) {
        //         echo $e; exit;
        //         $custom_error = ValidationException::withMessages([
        //             'internal_server' => ['Failed to add new transaction. Please try again in a few moment.'],
        //          ]);
        //          $response['message'] = $custom_error->getMessage();
        //          $response['errors'] = $custom_error->errors();
        //          $response['code'] = 500;
        //     }
        // }
        // return response()->json($response);
        // $remaining_b
    }
}
