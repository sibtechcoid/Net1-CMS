<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class BannerNetone extends Model
{

    public $table = 'BannerNetones';
    


    public $fillable = [
        'banner_name',
        'banner_picture',
        'banner_url',
        'banner_order'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'banner_name' => 'string',
        'banner_picture' => 'string',
        'banner_url' => 'string',
        'banner_order' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];
}
