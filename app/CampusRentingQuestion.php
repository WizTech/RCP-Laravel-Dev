<?php

namespace App;
use App\CampusModel;
use Illuminate\Database\Eloquent\Model;

class CampusRentingQuestion extends Model
{
  protected $table = 'campus_renting_question';
  protected $fillable = [
    'campus_id','image','alt','title','description'
  ];

  public function campus()
  {
    return $this->belongsTo('App\CampusModel');
  }
}
