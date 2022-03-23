<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slideshow extends Model
{
    //Slideshow Model
    protected $table = 'slideshow';
    protected $fillable = ['name', 'title', 'caption', 'url', 'status'];
}
