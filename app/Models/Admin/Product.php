<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;



class Product extends Model
{

    public $table = 'product';
    
    public $timestamps = false;
   
    protected $fillable = ['offer_id','offer_name','display_name','description','charging_type','offer_type','service_zone','total_price','validity_date',];

    protected $hidden = ['created_at', 'updated_at'];

    public function getTableColumns() {
        $column_names = $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
        $column_names = array_diff($column_names, array('created_at', 'updated_at'));
        return $column_names;
    }
}
