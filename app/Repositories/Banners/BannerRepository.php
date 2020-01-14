<?php

namespace App\Repositories\Banners;

use App\Models\Banners\Banner;
use InfyOm\Generator\Common\BaseRepository;

class BannerRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Banner::class;
    }
}
