<?php

namespace App\rcpadmin;

use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    protected $table = "career";
    protected  $fillable = ['title','career_type','description','location','hours','status'];
}
