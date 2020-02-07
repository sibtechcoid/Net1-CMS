<?php

namespace App\Excel\Imports;

use App\Models\Reward;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Validation\ValidationException;

class RedeemImport implements ToModel, WithHeadingRow, WithValidation
{
    use Importable;
    private $row = 0;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        ++$this->row;
        $row['msisdn'] = preg_replace('/[^0-9]/','', $row['msisdn']);
        $reward = Reward::where('msisdn', $row['msisdn'])->first();
        // dd($reward);exit;
        // $id = $row['id_reward'];
        // unset($row['id_reward']);
        // $username = auth()->user()->first_name + auth()->user()->last_name;
        $username = "tester";
        $now = Carbon::now();
        $row['point_reward'] = abs($row['point_reward']);
        $row['last_update'] = $now;
        if($reward !== null ) {
            // Reward exists, subtract point reward
            if($reward['point_reward'] >= $row['point_reward']) {
                $row['point_reward'] = ($reward['point_reward'] - $row['point_reward'])*1;
            }
            else {
                $row['point_reward'] = $reward['point_reward'];
            }
            // dd($row);exit;
            $reward = Reward::where('msisdn', $row['msisdn'])->update([
                'point_reward' => $row['point_reward'], 
                'user' => $username,
                'last_update' => $row['last_update']
            ]);
        }
        else {
            // echo $this->row;exit;
            // dd($row);exit;
            $exception = ValidationException::withMessages(['msisdn' => 'The msisdn is not found.']);
            $values = '';
            unset($row['last_update']);
            foreach($row as $key => $value) {
                $values .= $key .' -> '. $value .', ';
            }
            $failures[0] = [
                'row' => $this->row,
                'attribute' => 'msisdn',
                'error' => 'The msisdn is not found.',
                'values' => $values
            ];
            throw new \Maatwebsite\Excel\Validators\ValidationException($exception, $failures);
        }
    }

    public function rules(): array 
    {
        return [
            'msisdn' => 'required|regex:/^[+]?+[0-9]+$/',
            'point_reward' => 'required|numeric',
            'description' => 'nullable'
        ];
    }
}
