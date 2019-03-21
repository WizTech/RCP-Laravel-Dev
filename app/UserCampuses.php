<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserCampuses extends Model
{
  protected $table = 'user_campuses';

  protected $fillable = [
    'user_id', 'campus_id'
  ];
}
