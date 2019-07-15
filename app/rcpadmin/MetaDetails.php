<?php

namespace App\rcpadmin;

use Illuminate\Database\Eloquent\Model;

class MetaDetails extends Model
{
  protected $table = 'meta_details';
  protected $fillable = [
       'campus_id', 'meta_title','meta_description','meta_keywords','page_type'
     ];
}
