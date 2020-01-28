<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class DevicesNetOne extends Model
{

    public $table = 'DevicesNetOnes';
    


    public $fillable = [
        
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'devices__name' => 'string',
        'i_c_c_i_d' => 'string',
        'i_m_s_i' => 'string',
        'r_s_r_p' => 'string',
        'version__apps' => 'string',
        's_s_i_d' => 'string',
        'user__connection' => 'string',
        'i_p__address' => 'string',
        'm_a_c__address' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];
}
