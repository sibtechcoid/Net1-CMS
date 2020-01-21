<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\ZonePrice;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;

class ZonePriceController extends Controller
{
	public function show(Request $request, $product_id, $zone_id)
	{
		$zone_id = str_replace(' ', '', $zone_id);
		$zone_id = strtoupper($zone_id);
		$zonePrice = $this->isZonePriceExist($product_id, $zone_id);
		if($zonePrice) {
			$response['zonePrice'] = $zonePrice;
			$response['code'] = 200;
		}
		else {
			$custom_error = ValidationException::withMessages([
				'product_id' => ['Invalid product_id or zone_id.'],
				'zone_id' => ['Invalid product_id or zone_id.']
				]);
			$response['message'] = 'Product or Zone Price with given id(s) not found.';
			$response['errors'] = $custom_error->errors();
			$response['code'] = 404;
		}
        return response()->json($response);
	}

	public function store(Request $request)
	{
		$request->validate([
			'product_id' => 'required|numeric',
			'zone_id' => 'required',
			'zone_price' => 'required|numeric'
		]);

		// Check if given product_id and zone_id exists
		$zone_id = str_replace(' ', '', $request->zone_id);
		$zone_id = strtoupper($zone_id);
		$zonePrice = $this->isZonePriceExist($request->product_id, $zone_id);
        if($zonePrice){
        	$custom_error = ValidationException::withMessages([
               'zone_id' => ['Zone id in product is exist. Please add new zone id.'],
            ]);
            $response['message'] = $custom_error->getMessage();
            $response['errors'] = $custom_error->errors();
            $response['code'] = 422;
            return response($response);
		}
		// If given product_id and zone_id to be inserted is not exist, then try insert
        try {
            $zonePrice = new ZonePrice;
           	$zonePrice->product_id = $request->product_id;
           	$zonePrice->zone_id = $zone_id;
           	$zonePrice->zone_price = $request->zone_price;
            $zonePrice->save();

            $response['message'] = 'New Zone Price added.';
            $response['code'] = 200;
        }
        catch (\Exception $e) {
            $custom_error = ValidationException::withMessages([
               'internal_server' => ['Failed to add new zone price. Try again in a few moment.'],
            ]);
            $response['message'] = $custom_error->getMessage();
            $response['errors'] = $custom_error->errors();
            $response['code'] = 500;
        }        
        return response()->json($response);
	}

	public function update(Request $request, $product_id, $zone_id)
	{
		$request->validate([
			'product_id' => 'numeric',
			'zone_id' => 'min:1',
			'zone_price' => 'required|numeric|min:1'
		]);
		try {
			$zone_id = str_replace(' ', '', $zone_id);
			$zone_id = strtoupper($zone_id);
			$zonePrice = $this->isZonePriceExist($request->product_id, $zone_id);
			if($zonePrice) {
				$zonePrice = ZonePrice::whereRaw("product_id = ". $product_id ." AND zone_id ='". $zone_id ."'");
				$zonePrice->update(['zone_price' => $request->zone_price]);

	            $response['message'] = 'Zone price is updated.';
	            $response['code'] = 200;
	            return response($response);
			}
			else {
				$custom_error = ValidationException::withMessages([
					'product_id' => ['Invalid product_id or zone_id.'],
					'zone_id' => ['Invalid product_id or zone_id.']
				 ]);
				$response['message'] = 'Product or Zone Price with given id(s) not found.';
				$response['errors'] = $custom_error->errors();
				$response['code'] = 404;
			}
		}
		catch(\Exception $e) {
			$custom_error = ValidationException::withMessages([
               'internal_server' => ['Failed to update Zone Price. Try again in a few moment.'],
            ]);
            $response['message'] = $custom_error->getMessage();
            $response['errors'] = $custom_error->errors();
            $response['code'] = 500;
		}
		
		return response()->json($response);
	}

	private function isZonePriceExist($product_id, $zone_id)
	{
		return \DB::table('zone_prices')
        ->whereRaw("
        	zone_prices.product_id = ". $product_id ." AND 
            replace(zone_prices.zone_id, ' ', '') = '". 
			$zone_id ."'")->first();
	}
}
