<?php


namespace App\Excel\Imports;

use App\Models\ProductNetOne;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
// use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithValidation;

class ProductsImport implements ToModel, WithHeadingRow, WithValidation
{
    use Importable;
    /**
     * @inheritDoc
     */
    public function model(array $row)
    {
        // echo "<pre>";
        // print_r($row);
        // echo "</pre>";
        // Record import time
        // $now = Carbon::now();
        // Find the product
        $product = ProductNetOne::find($row['id']);
        $id = $row['id'];
        unset($row['id']);
        if($product !== null ) {
            // Product exists, update existing product
            unset($row['display_name']);
            unset($row['validity_date']);
            $product = ProductNetOne::where('id', $id)->update($row);
        }
        else {
            // Product doesn't exist, insert new product
            // $product = Product::create($row);
            return new ProductNetOne($row);
        }
    }

    public function rules(): array 
    {
        return [
            'offer_id' => 'required|numeric',
            'offer_name' => 'required|string|min:3|max:255',
            'display_name' => 'required|string|min:3|max:255',
            'description' => 'required',
            'charging_type' => 'required',
            'offer_type' => 'required',
            'service_zone' => 'required',
            'total_price' => 'numeric',
            'validity_date' => 'required|date',
        ];
    }
}

