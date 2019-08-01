<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class LandlordWebDetails extends Model
{
  protected $table = 'landlord_web_details';
  protected $guarded = [];
  public $timestamps = false;

  public function user()
  {
    return $this->hasOne('App\User');
  }

}
