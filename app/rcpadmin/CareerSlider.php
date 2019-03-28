<?php

namespace App\rcpadmin;

use Illuminate\Database\Eloquent\Model;

class CareerSlider extends Model
{
    protected $table = "career_slider";
    protected $fillable = ['slider_image','slider_type','slider_heading_one','slider_heading_two','slider_minute','status'];
}
