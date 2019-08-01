<?php

namespace App\Helpers;

use DB;
use Auth;

class GeneralHelper
{
    static function getColumnById($table, $column, $id)
    {
        $columnName = DB::table($table)
            ->select($column)
            ->where('id', $id)
            ->get();
        return $columnName;
    }

    static function getColumnByKeyValue($table, $column, $whereClause = '')
    {
        $columnName = DB::table($table)
            ->select($column)
            ->where([$whereClause])
            ->get();
        return $columnName;
    }

    static function getColumn($table, $columnName)
    {
        $column = DB::table($table)
            ->select('id', $columnName)->orderBy($columnName, 'ASC')
            ->get()
            ->toArray();
        return $column;
    }

    static function getColumnUsingJoin($table, $columnName, $whereClause = '')
    {
        $column = DB::table($table)
            ->select('id', $columnName)->orderBy($columnName, 'ASC')
            ->join('users', 'users.id', '=', 'landlord_details.user_id')
            ->where([$whereClause])
            ->get()
            ->toArray();
        return $column;
    }

    static function selectQuery($sql)
    {
        $leads = DB::select($sql);
        return $leads;
    }

    static function loggedInUserID(){
        $user_id = Auth::user()->id;
    }

    static function getNameById($table, $column, $id)
    {
        $columnName = DB::table($table)
            ->select($column)
            ->where('id', $id)
            ->first();
        return $columnName->$column;
    }

    static function EditLogFile($module_id, $logs, $beforeData = '', $afterData = '', $filters = 0)
    {
        $user_id = Auth::user()->id;
        DB::table('admin_user_logs')->insert(
            [
                'module_id' => $module_id,
                'filters' => $filters,
                'user_id' => $user_id,
                'text' => $logs,
                'before_change' => $beforeData,
                'after_change' => $afterData
            ]
        );
        return true;
    }

    static function module_data($controller_name){
        $module_info = DB::table('admin_modules')->where('controller', $controller_name)->first();
        return $module_info;
    }

}

?>