<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Str;

class News extends Model
{
    //News Model
    protected $table = 'news';
    protected $fillable = ['title', 'description', 'content', 'image', 'sort_order', 'status'];

    public function getUrl(){
        return Str::of(strtolower($this->title))->slug('-');
    }
}

