<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Str;

class Product extends Model
{
    //Product model
    protected $table = 'products';
    protected $fillable = ['name', 'quantity', 'NXB', 'NamXB', 'author', 'price', 'sale', 'status', 'description', 'content', 'image', 'category_id'];

    public function getUrl(){
        return Str::of(strtolower($this->name))->slug('-');
    }

    public function newPrice()
    {
        return $this->price - ($this->price * $this->sale/100);
    }
}
