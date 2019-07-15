<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\FeatureType;
class FeatureModel extends Model
{
  protected $table = 'feature';
  protected $fillable = ['name','type'];
  public $timestamps = false;

  public function type()
  {
    return $this->hasOne('App\FeatureType','id','type');
  }
 
public function featureType()
  {
    return $this->belongsTo('App\FeatureType','type','id');

  }
}
