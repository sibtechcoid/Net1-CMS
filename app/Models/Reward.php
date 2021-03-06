<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Reward extends Model
{

    public $table = 'Rewards';
    

    protected $primaryKey = 'id_reward';

    public $fillable = [
        'msisdn',
        'point_reward',
        'last_update',
        'user'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'msisdn' => 'string',
        'point_reward' => 'integer',
        'user' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function getTableColumns() {
        $column_names = $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
        $column_names = array_diff($column_names, array('last_update', 'user', 'created_at', 'updated_at'));
        return $column_names;
    }
}
