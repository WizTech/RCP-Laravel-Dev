<?php

namespace App\rcpadmin;

use Illuminate\Database\Eloquent\Model;

class BounceRate extends Model
{
    protected $connection = "mysql2";
    protected $table = "app_views";

}
