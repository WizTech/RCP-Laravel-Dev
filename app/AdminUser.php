<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


use App\Role;
use App\CampusModel;
/*use App\AdminModules;*/

use App\Models\AdminModules;
use App\ModulePermissions;
use DB;

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
        return $this->belongsToMany('App\Models\AdminModules', 'module_permissions', 'admin_id', 'module_id')->using('App\ModulePermissions');
    }

    static function activity_export($user_id, $date_from, $date_to)
    {
        $activities = DB::table('admin_user_logs')
            ->select('admin_user_logs.*', 'admin_users.username as user_name', 'admin_modules.title as module_title')
            ->join('admin_users', 'admin_users.id', '=', 'admin_user_logs.user_id')
            ->join('admin_modules', 'admin_modules.id', '=', 'admin_user_logs.module_id')
            ->where('admin_user_logs.user_id',$user_id)
            ->whereBetween('admin_user_logs.created_at', [$date_from, $date_to])
            ->get();
        return $activities;
    }

}
