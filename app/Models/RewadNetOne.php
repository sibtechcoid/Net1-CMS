<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class RewadNetOne extends Model
{

    public $table = 'RewadNetOnes';
    


    public $fillable = [
        'nama_rewads',
        'validity_date'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'nama_rewads' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];
}
