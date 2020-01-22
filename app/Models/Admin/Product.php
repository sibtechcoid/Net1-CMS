<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;



class Product extends Model
{

    public $table = 'products';
    


    public $fillable = [
        // tambah plan_id,zone_price_status,product_price
        'plan_id', // +
        'plan',
        'product_type',
        'product_name',
        'product_speed',
        'product_description',
        'product_expiry_in_days',
        'publish'
        'zone_price_status', //+
        'product_price', // +
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'plan' => 'string',
        'product_type' => 'string',
        'product_name' => 'string',
        'product_speed' => 'integer',
        'product_description' => 'string',
        'publish' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'plan' => 'required',
        'product_type' => 'required',
        'product_name' => 'required',
        'product_speed' => 'required',
        'product_description' => 'required',
        'product_expiry_in_days' => 'required',
        'publish' => ''
    ];

    public function zonePrices() {
        return $this->hasMany('App\Models\Admin\ZonePrice');
        // sebelumnya (return $this->hasMany('App\ZonePrice');) <- backend
    }
}
