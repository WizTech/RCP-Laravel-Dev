<?php

namespace App\rcpadmin;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';
    protected $fillable  = ['heading', 'link', 'image', 'description', 'status'];
}
