<?php


namespace App\Excel\Imports;

use App\Models\Admin\Product;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Carbon\Carbon;
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
        $now = Carbon::now();
        $validity_date = Carbon::parse($now);
        $row['validity_date'] = $validity_date;
        // Find the product
        $product = Product::find($row['id']);
        $id = $row['id'];
        unset($row['id']);
        if($product !== null ) {
            // Product exists, update existing product
            unset($row['display_name']);
            unset($row['validity_date']);
            $product = Product::where('id', $id)->update($row);
        }
        else {
            // Product doesn't exist, insert new product
            // $product = Product::create($row);
            return new Product($row);
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

    // public function collection(Collection $rows)
    // {
    //     $now = Carbon::now(); // get current date_time
    //     $product = new Product;
    //     $column_names = $product->getTableColumns(); //get all column names on a product table

    //     // Comparing column names, if the column names are the same, $headers_comparison = null
    //     $headers_comparison=array_diff($rows[0]->toArray(), $column_names);
    //     unset($rows[0]);
    //     if($headers_comparison == null) {
    //         // echo "<pre>";
    //         // print_r($column_names);
    //         // print_r($rows);
    //         // echo "</pre>";
    //         foreach($rows->toArray() as $row) {
    //             echo $row[0];
    //             $id = $row[0];
    //             $product = Product::find($id); // find product by id
    //             print_r($product);
    //             $fields = array_combine($column_names, $row);
    //             $fields['validity_date'] = Carbon::parse($now);
    //             // echo "<pre>";
    //             // print_r($product);
    //             // echo "</pre>";
    //             $fields['display_name'] =  trim($fields['display_name'], ' ');
    //             $display_name_length = strlen($fields['display_name']);
    //             if( $display_name_length < 3 || $display_name_length > 255 ) 
    //             {
    //                 // throw error

    //             }
    //             if($product !== null ) {
    //                 // Product exists, update existing product
    //                 unset($fields['id']);
                    
    //                 Product::where('id', $id)->update($fields);
    //             }
    //             else {
    //                 // Product doesn't exist, insert new product
    //                 echo "product doesn't exist";
    //                 Product::create($fields);
    //             }
    //         }
    //         // $validator = Validator::make($rows->toArray(), [
    //         //     '0' => 'exists:'.$product->table,
    //         //     '1' => 'numeric',
    //         //     '2' => 'numeric'
    //         // ]);
    //         // if($validator->fails()) {
    //         //     echo $validator->errors()->first();
    //     }
    // }
}

