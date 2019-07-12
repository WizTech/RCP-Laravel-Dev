<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyImage extends Model
{
  protected $table = 'property_images';
  public $timestamps = false;
  protected $fillable = [
    'property_id', 'floorplan_id', 'image', 'order', 'date', 'featured'
  ];
}
