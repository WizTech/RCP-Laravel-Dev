<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class UserDetails extends Model
{
   protected $table = 'user_details';
  protected $fillable = [
    'user_id','first_name',  'last_name','phone_no','address'
  ];

  public function user()
  {
    return $this->hasOne('App\User');
  }

}
