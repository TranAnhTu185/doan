<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    //Contact Model
    protected $table = 'contacts';
    protected $fillable = ['name', 'logo', 'phone', 'phone_other', 'work_time', 'address', 'email', 'description', 'facebook', 'note'];
}
