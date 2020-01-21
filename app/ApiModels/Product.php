<?php

namespace App\ApiModels;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'plan_id', 
        'product_type_id', 
        'product_name', 
        'product_speed', 
        'product_description', 
        'product_expiry_in_days', 
        'publish',
        'zone_price_status',
        'product_price'
    ];
    
    public function zonePrices() {
    	return $this->hasMany('App\ZonePrice');
    }
}
