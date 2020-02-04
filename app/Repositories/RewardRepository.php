<?php

namespace App\Repositories;

use App\Models\Reward;
use InfyOm\Generator\Common\BaseRepository;

class RewardRepository extends BaseRepository
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
        return Reward::class;
    }
}
