<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnsubscriberModel extends Model
{
    protected $table = 'unsubscribers';
    protected $fillable = ['email'];
}
