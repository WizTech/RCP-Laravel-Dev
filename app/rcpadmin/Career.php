<?php

namespace App\rcpadmin;

use Illuminate\Database\Eloquent\Model;

use App\rcpadmin\CareerType;

class Career extends Model
{
  protected $table = "career";
  protected $fillable = ['title', 'career_type', 'description', 'location', 'hours', 'status'];

  public function type()
  {
    return $this->hasOne('App\rcpadmin\CareerType', 'id', 'career_type');
  }
}
