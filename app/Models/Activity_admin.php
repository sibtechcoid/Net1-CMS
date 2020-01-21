<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity_admin extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_activity';

    protected $casts = [
        'removable' => 'boolean'
    ];

    protected $fillable = ['description', 'user_id', 'ip_address', 'user_agent'];


}