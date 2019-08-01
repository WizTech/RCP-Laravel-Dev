<?php

namespace App\rcpadmin;

use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
  protected $table = 'pages';
  protected $guarded = [];
  public $timestamps = false;
}
