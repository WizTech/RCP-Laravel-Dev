<?php

namespace App;

use App\CampusModel;
use Illuminate\Database\Eloquent\Model;

class LinkedCampusModel extends Model
{
  protected $table = 'linked_campuses';
  protected $fillable = [
    'campus_id', 'linked_campus_id'
  ];
  public $timestamps = false;

  public function campuses()
  {
    return $this->belongsToMany('App\CampusModel', 'linked_campuses');
  }

}
