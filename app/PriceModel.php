<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PriceModel extends Model
{
    protected $table = 'price';
    protected $fillable = ['name','floorplans_allowed','price_one_month','price_six_month','status'];
}
