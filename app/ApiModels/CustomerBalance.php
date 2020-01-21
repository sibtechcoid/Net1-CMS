<?php

namespace App\ApiModels;

use Illuminate\Database\Eloquent\Model;

class CustomerBalance extends Model
{
    protected $table = 'customer_balances';
    protected $primaryKey = 'customer_id';
}
