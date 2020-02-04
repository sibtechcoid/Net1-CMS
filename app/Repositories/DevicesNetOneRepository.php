<?php

namespace App\Repositories;

use App\Models\DevicesNetOne;
use InfyOm\Generator\Common\BaseRepository;

class DevicesNetOneRepository extends BaseRepository
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
        return DevicesNetOne::class;
    }
}
