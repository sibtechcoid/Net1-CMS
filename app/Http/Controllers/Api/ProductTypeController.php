<?php

namespace App\Http\Controllers\Api;

use App\ApiModels\ProductType;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductTypeController extends Controller
{
    
    public function index()
    {
        $response['productTypes'] = ProductType::all();
        $response['code'] = 200;
        return response()->json($response);
    }

    public function show(ProductType $productType)
    {
        $response['productType'] = $productType;
        $response['code'] = 200;
        return response()->json($response);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_type' => 'required|unique:product_types'
        ]);
        $product_type = $this->isProductTypeExist($request->product_type);
        if($product_type) {
            $custom_error = ValidationException::withMessages([
                'product_name' => ['Product Type exists. Please choose/use another product type.'],
            ]);
            $response['message'] = $custom_error->getMessage();
            $response['errors'] = $custom_error->errors();
            $response['code'] = 422;
            return response()->json($response);
        }
        try {
            $product_type = new ProductType;
            $product_type->product_type = $request->product_type;
            $product_type->save();
            $response['message'] = 'New Product Type added.';
            $response['code'] = 200;
        }
        catch(\Exception $e) {
            $custom_error = ValidationException::withMessages([
                'internal_server' => ['Failed to add new Product Type. Try again in a few moment.'],
            ]);
            $response['message'] = $custom_error->getMessage();
            $response['errors'] = $custom_error->errors();
            $response['code'] = 500;
        }

        return response()->json($response);
    }

    public function update(Request $request, ProductType $productType)
    {
        $request->validate([
            'product_type_id' => 'min:1|unique:product_types',
        ]);
        try {
            // Update the product type
            $data = $request->except(['_token', 'id']); // get all request variable, empty value filtered
            $filtered_data = array_filter($data);
            $productType->fill($filtered_data);
            $productType->save();

            $response['message'] = 'Product Type is updated.';
            $response['code'] = 200;
        }
        catch (\Exception $e) {
            $custom_error = ValidationException::withMessages([
               'internal_server' => ['Failed to update product type. Try again in a few moment.'],
            ]);
            $response['message'] = $custom_error->getMessage();
            $response['errors'] = $custom_error->errors();
            $response['code'] = 500;
        }
        return response()->json($response);
    }

    private function isProductTypeExist($product_type)
    {
        // Check if product name exists
        return \DB::table('product_types')
        ->whereRaw("
            replace(product_types.product_type, ' ', '') = '". 
            str_replace(' ', '', $product_type)."'")->first();
    }
}
