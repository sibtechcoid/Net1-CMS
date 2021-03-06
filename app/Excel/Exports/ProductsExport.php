<?php

namespace App\Excel\Exports;

use App\Models\ProductNetOne;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ProductNetOne::all();
    }

    public function headings(): array {
        $product = new ProductNetOne;
        return [$product->getTableColumns()];
    }
}
