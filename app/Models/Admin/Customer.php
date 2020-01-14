<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;



class Customer extends Model
{

    public $table = 'customers';
    


    public $fillable = [
        'account_customer_segment',
        'residence_type',
        'msisdn',
        'account_name',
        'customer_cis_to_category',
        'customer_company_regnum',
        'customer_identity_no',
        'first_name',
        'last_name',
        'kk_number',
        'email',
        'password',
        'device_id',
        'preferred_language'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'account_customer_segment' => 'string',
        'residence_type' => 'string',
        'msisdn' => 'string',
        'account_name' => 'string',
        'customer_cis_to_category' => 'string',
        'customer_company_regnum' => 'string',
        'customer_identity_no' => 'string',
        'first_name' => 'string',
        'last_name' => 'string',
        'kk_number' => 'string',
        'email' => 'string',
        'password' => 'string',
        'device_id' => 'string',
        'preferred_language' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'account_customer_segment' => 'required',
        'residence_type' => 'required',
        'msisdn' => 'required|integer',
        'account_name' => 'required',
        'customer_cis_to_category' => 'required',
        'customer_company_regnum' => 'required',
        'customer_identity_no' => 'required',
        'first_name' => 'required',
        'last_name' => 'required',
        'kk_number' => 'required|integer',
        'email' => 'required|email',
        'password' => 'required'
    ];
}
