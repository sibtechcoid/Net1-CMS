<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;



class ProductType extends Model
{

    protected $table = 'productlist';
    protected $fillable = ['offerID','offerName','description','chargingType','offerType','serviceZone','totalPrice'];

    // public $table = 'product_types';
    


    // public $fillable = [
    //     'product_type'
    // ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    // protected $casts = [
    //     'product_type' => 'string'
    // ];

    /**
     * Validation rules
     *
     * @var array
     */
    // public static $rules = [
    //     'product_type' => 'required'
    // ];
}
