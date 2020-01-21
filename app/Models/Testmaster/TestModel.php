<?php

namespace App\Models\Testmaster;

use Illuminate\Database\Eloquent\Model;



class TestModel extends Model
{

    public $table = 'testModels';
    


    public $fillable = [
        'nama'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'nama' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nama' => 'email'
    ];
}
