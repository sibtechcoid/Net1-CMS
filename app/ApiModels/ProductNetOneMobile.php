<?php

namespace App\ApiModels;

use Illuminate\Database\Eloquent\Model;

class ProductNetOneMobile extends Model
{
    //
    public $table = 'Productnetones';
    public $timestamps = false;
   
    protected $fillable = ['offer_id','display_name','description','charging_type','offer_type','service_zone','total_price','validity_date',];
}
