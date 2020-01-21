<?php

namespace App\ApiModels;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class User extends Model
{
	use HasApiTokens;
    protected $table = "users";
    // protected $hidden = ['password'];
}
