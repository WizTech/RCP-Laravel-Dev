<?php
namespace App\Helpers;
use DB;

class GeneralHelper
{
    static function getColumnById($table, $column, $id){
        $columnName  = DB::table($table)
            ->select($column)
            ->where('id',$id)
            ->get();
        return $columnName;
    }

    static function getColumn($table, $columnName){
        $column  = DB::table($table)
            ->select($columnName)->orderBy($columnName, 'ASC')
            ->get()
            ->toArray();
        return $column;
    }


}

?>