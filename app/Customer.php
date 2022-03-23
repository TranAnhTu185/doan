<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    //Customer model
    use Notifiable;

    protected $guard = 'customers';

    protected $fillable = ['name', 'phone', 'email', 'password', 'address'];
}
