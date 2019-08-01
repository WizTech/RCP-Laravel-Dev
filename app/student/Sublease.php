<?php

namespace App\student;

use Illuminate\Database\Eloquent\Model;

class Sublease extends Model
{
  protected $table = "roommate";
  protected $guarded = [];
  public $timestamps = false;
}
