<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Productlist extends Model
{
    //model get api bss
    public $timestamps = false;
    protected $table = 'productlist';
    protected $fillable = ['offerID','offerName','description','chargingType','offerType','serviceZone','totalPrice'];
}
