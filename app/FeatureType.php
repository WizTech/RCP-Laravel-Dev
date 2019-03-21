<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\FeatureModel;

class FeatureType extends Model
{
  protected $table = 'feature_type';
  public $timestamps = false;

  public function feature()
   {

     return $this->belongsTo('App\FeatureModel','type');

   }
}
