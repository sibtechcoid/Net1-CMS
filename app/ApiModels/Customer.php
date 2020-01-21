<?php

namespace App\ApiModels;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Customer extends Authenticatable
{
    use Notifiable, HasApiTokens;

    protected $hidden = ['password'];

    public function findForPassport($msisdn) {
        return $this->where('msisdn', $msisdn)->first();
    }
}
