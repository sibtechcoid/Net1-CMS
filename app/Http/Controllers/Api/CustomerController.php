<?php

namespace App\Http\Controllers\Api;

use App\ApiModels\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{

	public function index()
    {
        $response['customers'] = Customer::all();
        $response['code'] = 200;
        return response()->json($response);
    }

    public function show(Customer $customer)
    {
    	// var_dump($customer);exit;
    	$response['customer'] = $customer
        ->leftJoin('customer_addresses', 'customers.id', '=', 'customer_addresses.customer_id')
        ->leftJoin('customer_contacts', 'customers.id', '=', 'customer_contacts.customer_id')
        ->select(['customers.*', 'customer_addresses.*', 'customer_contacts.*'])
        ->where('customers.id', '=', $customer->id)->first();
        $response['code'] = 200;
        return response()->json($response);
    }
}
