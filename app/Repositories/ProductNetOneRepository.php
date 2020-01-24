<?php

namespace App\Repositories;

use App\Models\ProductNetOne;
use InfyOm\Generator\Common\BaseRepository;

class ProductNetOneRepository extends BaseRepository
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
        return ProductNetOne::class;
    }
}
