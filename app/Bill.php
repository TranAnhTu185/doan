<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    //Bill model
    protected $table = 'bills';
    protected $fillable = ['customer_id', 'created', 'payments', 'status', 'name', 'phone', 'address'];

    public function bill_customer()
    {
        return $this->belongsTo('App\Customer', 'customer_id', 'id');
    }

    public function bill_billdetail()
    {
        return $this->hasMany('App\BillDetail', 'bill_id', 'id');
    }
}
