<?php
namespace App\Helpers;

use DB;

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

  static function getColumnByKeyValue($table, $column, $whereClause='')
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
  static function getColumnUsingJoin($table, $columnName,$whereClause='')
  {
    $column = DB::table($table)
      ->select('id', $columnName)->orderBy($columnName, 'ASC')
      ->join('users', 'users.id', '=', 'landlord_details.user_id')
      ->where([$whereClause])
      ->get()
      ->toArray();
    return $column;
  }

  static function selectQuery($sql){
    $leads = DB::select($sql);
    return $leads;
  }


}

?>