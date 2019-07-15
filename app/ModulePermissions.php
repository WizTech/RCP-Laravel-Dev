<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\AdminUser;
use App\Models\AdminModules;

class ModulePermissions extends Model
{
  protected $table = 'module_permissions';
  protected $fillable = ['admin_id','module_id','module_option_id'];

 /* public function admin(){
    return $this->belongsToMany('App\AdminUser')->using('App\Models\AdminModules');
  }*/
}
