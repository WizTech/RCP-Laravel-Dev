<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TemplateModel extends Model
{
  protected $table = 'template';
  public $timestamps = false;
  protected $fillable = ['name','slug','subject','body'];
}
