<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminCampuses extends Model
{
    //
  protected $table = 'admin_campuses';

  protected $fillable = [
     'admin_id', 'campus_id'
   ];
}
