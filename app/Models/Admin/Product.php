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
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }
}
