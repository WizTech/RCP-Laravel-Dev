<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlockIPModel extends Model
{
  protected $table = 'block_ip';
  protected $fillable = ['ip'];
}
