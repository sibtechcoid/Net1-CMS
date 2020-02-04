<?php

namespace App\Excel\Imports;

use App\Models\Reward;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Carbon\Carbon;
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
        $reward = Reward::where('msisdn', $row['msisdn'])->first();
        // dd($reward);exit;
        // $id = $row['id_reward'];
        // unset($row['id_reward']);
        // $username = auth()->user()->first_name + auth()->user()->last_name;
        $username = "tester";
        $now = Carbon::now();
        $row['last_update'] = $now;
        if($reward !== null ) {
            // Reward exists, add point reward
            $row['point_reward'] = ($reward['point_reward'] + $row['point_reward'])*1;
            // dd($row);exit;
            $reward = Reward::where('msisdn', $row['msisdn'])->update([
                'point_reward' => $row['point_reward'], 
                'user' => $username,
                'last_update' => $row['last_update']
            ]);
        }
        else {
            // Reward doesn't exist, insert new reward
            $row['user'] = 'tester';
            // dd($row);exit;
            return new Reward($row);
        }
    }

    public function rules(): array 
    {
        return [
            'msisdn' => 'required',
            'point_reward' => 'required|numeric',
            'description' => 'nullable'
        ];
    }
}
