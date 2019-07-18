<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\AdminUser;
use App\Models\AdminModules;

class ModulePermissions extends Model
{
    protected $table = 'module_permissions';
    protected $fillable = ['admin_id', 'module_id', 'module_option_id'];

    /*public function admin(){
       return $this->belongsToMany('App\AdminUser')->using('App\Models\AdminModules');
     }*/

    static function export_activities($date_from, $date_to, $admin_id, $module_id)
    {
        $adminActivities = DB::table('module_permissions')
            ->select('admin_id', 'module_id', 'module_option_id')
            //->whereBetween('date', [$date_from, $date_to])
            ->get();
        return $adminActivities;
    }

}
