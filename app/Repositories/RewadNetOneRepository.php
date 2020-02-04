<?php

namespace App\Repositories;

use App\Models\RewadNetOne;
use InfyOm\Generator\Common\BaseRepository;

class RewadNetOneRepository extends BaseRepository
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
        return RewadNetOne::class;
    }
}
