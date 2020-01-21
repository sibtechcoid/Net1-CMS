<?php

namespace App\ApiModels;

use Illuminate\Database\Eloquent\Model;

class ZonePrice extends Model
{
    protected $table = "zone_prices";
    protected $fillable = [
    	'zone_id',
    	'zone_price'
    ];

    // public function product()
    // {
    // 	return $this->belongsTo('App\Product', 'product_id');
    // }
}
