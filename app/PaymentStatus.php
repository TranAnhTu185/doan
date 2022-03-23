<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentStatus extends Model
{
    //Payment Status Model
    protected $table = 'payment_status';
    protected $fillable = ['name', 'note'];
}
