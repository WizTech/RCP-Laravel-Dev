<?php

namespace App\rcpadmin;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $table = 'resources';
    protected $fillable  = ['campus_id', 'title', 'link', 'image', 'description','status'];
}
