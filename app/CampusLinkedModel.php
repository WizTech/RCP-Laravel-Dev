<?php

namespace App;

use App\CampusModel;
use Illuminate\Database\Eloquent\Model;

class CampusLinkedModel extends Model
{
  protected $table = 'campus_linked';
  protected $fillable = [
    'campus_id', 'campus_linked'
  ];
  public $timestamps = false;

  public function campuses()
  {
    return $this->belongsToMany('App\CampusModel', 'campus_linked','campus_id','campus_linked');
  }

}
