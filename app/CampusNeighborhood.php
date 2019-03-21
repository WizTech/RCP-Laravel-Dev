<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CampusNeighborhood extends Model
{
  protected $table = 'campus_neighborhood';
    protected $fillable = [
      'campus_id','image','alt','title','description'
    ];

    public function campus()
    {
      return $this->belongsTo('App\CampusModel');
    }
}
