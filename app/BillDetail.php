<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillDetail extends Model
{
    //BillDetail Model
    protected $table = 'bill_detail';
    protected $fillable = ['bill_id', 'product_id', 'quantity', 'price'];

    public function billdetail_product()
    {
        return $this->belongsTo('App\Product', 'product_id', 'id');
    }
}
