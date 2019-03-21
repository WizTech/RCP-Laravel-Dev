<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CampusDestination extends Model
{
  protected $table = 'campus_destination';
  protected $fillable = [
    'campus_id', 'name', 'address', 'lat', 'lng'
  ];

  public function campus()
  {
    return $this->belongsTo('App\CampusModel');
  }
}
