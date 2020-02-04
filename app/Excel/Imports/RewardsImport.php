<?php

namespace App\Imports;

use App\Models\Reward;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
// use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithValidation;

class RewardsImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // $reward = Reward::find($row['id']);
        // $id = $row['id'];
        // unset($row['id']);
        // if($reward !== null ) {
        //     // Product exists, update existing product
        //     unset($row['display_name']);
        //     unset($row['validity_date']);
        //     $reward = Reward::where('id', $id)->update($row);
        // }
        // else {
        //     // Product doesn't exist, insert new product
        //     // $product = Product::create($row);
        //     return new Reward($row);
        // }
    }

    public function rules(): array 
    {
        return [
            
        ];
    }
}
