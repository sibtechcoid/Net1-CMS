<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class ProductNetOne extends Model
{

    public $table = 'Productnetones';
    // public $timestamps = false;
   
    protected $fillable = ['offer_id','offer_name','display_name','description','charging_type','offer_type','service_zone','total_price','validity_date',];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'offer_id' => 'string',
        'offer_name' => 'string',
        'display_name' => 'string',
        'description' => 'string',
        'charging_type' => 'string',
        'offer_type' => 'string',
        'service_zone' => 'string'
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
        $column_names = array_diff($column_names, array('created_at', 'updated_at'));
        return $column_names;
    }
}
