<?php

namespace App\student;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
  protected $table = "application_detail";
  protected $guarded = [];
  public $timestamps = false;
}
