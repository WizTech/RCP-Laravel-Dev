<?php

namespace App\rcpadmin;

use Illuminate\Database\Eloquent\Model;

class CampusInsight extends Model
{
    protected $table = "campus_insight";
    protected $fillable = ['title','campus_id','pdf_file','link','status'];
}
