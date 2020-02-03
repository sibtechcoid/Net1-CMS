<?php


namespace App\Excel\Imports;

use App\Models\Admin\Product;
use Illuminate\Support\Collection;
// use Illuminate\Database\Eloquent\Model;
// use Maatwebsite\Excel\Concerns\ToModel;
// use Maatwebsite\Excel\Concerns\Importable;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
// use Maatwebsite\Excel\Concerns\WithValidation;
// use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToCollection
{
    // use Importable;

    /**
     * @inheritDoc
     */
//     public function model(array $row)
//     {
//         echo "<tr>";
// //        echo "<td>". $row[0] ."</td>";
// //        echo "<td>". $row[1] ."</td>";
// //        echo "<td>". $row[2] ."</td>";
//         $product = new Product;
//         $length = count($product->getTableColumns());
//         echo "<pre>";
//         print_r($row);
//         echo "</pre>";
//         //         foreach($row as $key => $column) {
// // //            if($column != '' || $column != null)
// //             echo "<td>$key ". $column ."</td>";
// //         }
// //         echo "</tr>";
// //        return new Product([
// //            'product_name' => $row[0]
// //        ]);
//     }

//     public function rules() 
//     {
//         return [];
//     }

    public function collection(Collection $rows)
    {
        $product = new Product;
        $column_names = $product->getTableColumns();

        // Comparing column names, if the column names are the same, $headers_comparison = null
        $headers_comparison=array_diff($rows[0]->toArray(), $column_names);
        unset($rows[0]);
        if($headers_comparison == null) {
            
            $validator = Validator::make($rows->toArray(), [
                '0' => 'exists:'.$product->table,
                '1' => 'numeric',
                '2' => 'numeric'
            ]);
            if($validator->fails()) {
                echo $validator->errors()->first();
            }
            // foreach($rows->toArray() as $row) {
            //     echo "<pre>";
            //     print_r($row);
            //     echo "</pre><br>";
            // }
        }
    }
}
