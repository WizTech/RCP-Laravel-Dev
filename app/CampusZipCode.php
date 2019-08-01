<?php

namespace App;

use App\CampusModel;
use Illuminate\Database\Eloquent\Model;

class CampusZipCode extends Model
{
  protected $table = 'campus_zipcode';
  protected $fillable = [
    'campus_id', 'zipcode'
  ];

  public function campus()
  {
    return $this->belongsTo('App\CampusModel');
  }
}
