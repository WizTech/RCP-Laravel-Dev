<?php

namespace App;
use App\CampusModel;
use Illuminate\Database\Eloquent\Model;

class CampusApartment extends Model
{
  protected $table = 'campus_apartment';
  protected $fillable = [
    'campus_id','h1', 'h2','meta_title','meta_description','seo_block'
  ];

  public function campus()
  {
    return $this->belongsTo('App\CampusModel');
  }
}
