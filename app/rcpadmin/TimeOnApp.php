<?php

namespace App\rcpadmin;

use Illuminate\Database\Eloquent\Model;

class TimeOnApp extends Model
{
    protected $connection = "mysql2";
    protected $table = "app_views";
}
