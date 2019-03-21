<?php

namespace App;
use App\CampusModel;
use Illuminate\Database\Eloquent\Model;

class CampusGuideModel extends Model
{
  protected $table = 'campus_guide';
  protected $fillable = [
    'campus_id','rent', 'life','image','alt','guide_title','guide_description','roommate_title','roommate_description','roommate_h1','roommate_copy','sublease_title','sublease_description','sublease_h1','sublease_copy'
  ];

  public function campus()
  {
    return $this->belongsTo('App\CampusModel');
  }
}
