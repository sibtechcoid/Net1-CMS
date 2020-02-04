<?php

namespace App\Repositories;

use App\Models\BannerNetone;
use InfyOm\Generator\Common\BaseRepository;

class BannerNetoneRepository extends BaseRepository
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
        return BannerNetone::class;
    }
}
