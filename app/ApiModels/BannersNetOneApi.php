<?php

namespace App\ApiModels;

use Illuminate\Database\Eloquent\Model;

class BannersNetOneApi extends Model
{
    // model for mobile database
    public $table = 'BannerNetones';
    


    public $fillable = [
        'banner_name',
        'banner_picture',
        'banner_url',
        'banner_order'
    ];
}
