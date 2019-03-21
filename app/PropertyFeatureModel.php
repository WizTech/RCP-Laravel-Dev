<?php

namespace App;
use App\Property;
use Illuminate\Database\Eloquent\Model;

class PropertyFeatureModel extends Model
{
  protected $table = 'property_features';
  protected $fillable = [
    'property_id', 'feature_id'
  ];
  public $timestamps = false;

  public function features()
  {
    return $this->belongsTo('App\Property');
  }
}
