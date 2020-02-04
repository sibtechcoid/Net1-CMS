<?php

namespace App\Repositories;

use App\Models\Bannerss;
use InfyOm\Generator\Common\BaseRepository;

class BannerssRepository extends BaseRepository
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
        return Bannerss::class;
    }
}
