<?php


namespace App\Excel;

use App\Models\Admin\Product;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;

class ProductsImport implements ToModel
{
    use Importable;

    /**
     * @inheritDoc
     */
    public function model(array $row)
    {
        echo "<tr>";
//        echo "<td>". $row[0] ."</td>";
//        echo "<td>". $row[1] ."</td>";
//        echo "<td>". $row[2] ."</td>";
        foreach($row as $column) {
//            if($column != '' || $column != null)
            echo "<td>". $column ."</td>";
        }
        echo "</tr>";
//        return new Product([
//            'product_name' => $row[0]
//        ]);
    }
}
