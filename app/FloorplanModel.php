<?php

namespace App;
use App\Property;
use Illuminate\Database\Eloquent\Model;

class FloorplanModel extends Model
{
    protected $table = 'floorplan';
    protected $fillable = [
        'property_id', 'title', 'bed', 'bath', 'price', 'sq_footage', 'available_date'
    ];
    public $timestamps = false;

    public function property()
    {
        return $this->belongsTo('App\Property');
    }
}
