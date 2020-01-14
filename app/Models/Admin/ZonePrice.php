<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;



class ZonePrice extends Model
{

    public $table = 'zone_prices';
    


    public $fillable = [
        'product_id',
        'zone_id',
        'zone_price'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'product_id' => 'integer',
        'zone_id' => 'string',
        'zone_price' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'zone_id' => 'required',
        'zone_price' => 'required'
    ];
}
