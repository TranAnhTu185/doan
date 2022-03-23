<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Str;

class Product extends Model
{
    //Product model
    protected $table = 'products';
    protected $fillable = ['name', 'quantity', 'image', 'price', 'sale', 'description', 'content', 'status', 'category_id'];

    public function product_image()
    {
        return $this->hasMany('App\Image', 'product_id', 'id');
    }

    public function getUrl(){
        return Str::of(strtolower($this->name))->slug('-');
    }

    public function newPrice()
    {
        return $this->price - ($this->price * $this->sale/100);
    }
}
