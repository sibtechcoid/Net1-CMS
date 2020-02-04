<?php

namespace App\Excel\Exports;

use App\Models\Reward;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RewardsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Reward::all();
    }

    public function headings(): array {
        $reward = new Reward;
        return [$reward->getTableColumns()];
    }
}
