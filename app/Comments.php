<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $table = 'comments';
    protected $fillable = ['product_id', 'customer_id', 'content'];

    public function product(){
        return $this->belongsTo('App\Product', 'product_id', 'id');
    }

    public function customer(){
        return $this->belongsTo('App\Customer', 'customer_id', 'id');
    }
}
