<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PurchaseOrderController extends Controller
{

    public function index()
    {
        $purchaseOrders = \DB::table('purchase_orders')->select('purchase_orders.*')->get();
        $response['purchaseOrders'] = $purchaseOrders;
        $response['code'] = 200;
        return response()->json($response);
    }

    public function store(Request $request)
    {
        $cust_id = auth()->user()->id;
        $cust_balance_avail = \DB::table('customer_balances')->where('customer_id', '=', $cust_id)->value('balance_available');
        $zone_id = 'z1';
        $zone_id = str_replace(' ', '', $zone_id);
        $zone_id = strtoupper($zone_id);
        $product = \DB::table('products')
        ->leftJoin('zone_prices', 'products.id', '=', 'zone_prices.product_id')
        ->where('products.id', '=', $request->product_id)
        ->where('zone_prices.zone_id', '=', $zone_id)
        ->select('products.id', 'products.product_name','zone_prices.zone_id', 'zone_prices.zone_price')
        ->first();
        $remaining_balance = number_format($cust_balance_avail - $product->zone_price, 2);
        if($remaining_balance >= 0){
            try {
                \DB::transaction(function () use ($request, &$response, &$cust_id, &$product, &$remaining_balance) {
                    $timestamp_now = Carbon::now();
                    \DB::table('purchase_orders')->insert([
                        'customer_id' => $cust_id,
                        'product_id' => $product->id,
                        'product_name' => $product->product_name,
                        'zone_id' => $product->zone_id,
                        'status' => 'active',
                        'price' => $product->zone_price,
                        'purchase_date' => $timestamp_now,
                        'created_at' => $timestamp_now,
                        'updated_at' => $timestamp_now
                    ]);
                    \DB::table('customer_balances')
                        ->where('customer_id', $cust_id)
                        ->update([
                            'balance_consumed' => $product->zone_price,
                            'balance_available' => $remaining_balance
                        ]);
                });
                $response['message'] = 'Transaction has done successfully.';
                $response['code'] = 200;
            }
            catch(\Exception $e) {
                echo $e; exit;
                $custom_error = ValidationException::withMessages([
                    'internal_server' => ['Failed to add new transaction. Please try again in a few moment.'],
                ]);
                $response['message'] = $custom_error->getMessage();
                $response['errors'] = $custom_error->errors();
                $response['code'] = 500;
            }
        }
        else {
            $custom_error = ValidationException::withMessages([
                'balance_available' => ['Not enough balance to complete the transaction. Failed to add new transaction.'],
            ]);
            $response['message'] = $custom_error->getMessage();
            $response['errors'] = $custom_error->errors();
            $response['code'] = 403;
        }

        return response()->json($response);
    }
}
