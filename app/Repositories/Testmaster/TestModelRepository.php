<?php

namespace App\Repositories\Testmaster;

use App\Models\Testmaster\TestModel;
use InfyOm\Generator\Common\BaseRepository;

class TestModelRepository extends BaseRepository
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
        return TestModel::class;
    }
}
