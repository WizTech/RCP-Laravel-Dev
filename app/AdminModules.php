<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\AdminUser;
use App\ModulePermissions;

class AdminModules extends Model
{
  //
  protected $table = 'admin_modules';

  public function admin()
  {
    return $this->belongsToMany('App\AdminUser')->using('App\ModulePermissions');
  }

}
