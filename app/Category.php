<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    //Category model
    protected $table = 'categories';
    protected $fillable = ['name', 'parent_id', 'sort_order'];

    public function getParent(){
        return Category::all()->where('parent_id', $this->id);
    }

    public function getUrl(){
        return Str::of(strtolower($this->name))->slug('-');
    }
}
