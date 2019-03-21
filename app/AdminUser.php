<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


use App\Role;
use App\CampusModel;
/*use App\AdminModules;*/
use App\Models\AdminModules;
use App\ModulePermissions;

class AdminUser extends Authenticatable
{
  use Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name', 'username', 'email', 'role_id', 'password', 'status', 'export_all_leads'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    /*'password',*/
    'remember_token'
  ];

  public function role()
  {
    return $this->belongsTo('App\Role');
  }

  public function campuses()
  {
    return $this->belongsToMany('App\CampusModel', 'admin_campuses', 'admin_id', 'campus_id');
  }

  public function scopeExceptCurrentUser($query)
  {
    return $query->where('id', '!=', Auth::user()->id);
  }

  /*public function modules()
  {
    return $this->hasMany('App\AdminModules');
  }*/

  public function modules()
  {
    return $this->belongsToMany('App\Models\AdminModules', 'module-permissions', 'admin_id', 'module_id')->using('App\ModulePermissions');
  }


}
