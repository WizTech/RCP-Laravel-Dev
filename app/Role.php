<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\AdminUser;
class Role extends Model
{
  protected $table = 'roles';

  // Role.php
  public function admin_users()
  {
    return $this->hasMany('App\AdminUser');
  }
  public function users()
  {
    return $this->hasMany('App\User');
  }
}
