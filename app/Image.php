<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    //Images Model
    protected $table = 'images';
    protected $fillable = ['name', 'product_id'];

    public function image_product()
    {
        return $this->belongsTo('App\Product', 'product_id', 'id');
    }
}
