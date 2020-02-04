<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class ProductNetOne extends Model
{

    public $table = 'Productnetones';
    public $timestamps = false;
   
    protected $fillable = ['offer_id','offer_name','display_name','description','charging_type','offer_type','service_zone','total_price','validity_date',];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'offer_id' => 'string',
        'offer_name' => 'string',
        'display_name' => 'string',
        'description' => 'string',
        'charging_type' => 'string',
        'offer_type' => 'string',
        'service_zone' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];
}
