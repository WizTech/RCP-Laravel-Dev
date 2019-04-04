<?php

namespace App\rcpadmin;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    //

    protected $table = 'testimonials';
    protected $fillable  = ['person_name', 'title', 'photo', 'company', 'market', 'text', 'status'];

}

