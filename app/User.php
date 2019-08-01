<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\UserDetails;
use App\LandlordWebDetails;
use App\UserCampuses;
use App\LandlordDetails;
use App\Role;
use App\CampusModel;
use Illuminate\Database\Eloquent\Model;
use DB;

class User extends Authenticatable
{
  use Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name', 'email', 'role_id', 'password', 'status', 'user_deleted'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'password', 'remember_token',
  ];

  public function campuses()
  {
    return $this->belongsToMany('App\CampusModel', 'user_campuses', 'user_id', 'campus_id');
  }

  public function role()
  {
    return $this->belongsTo('App\Role');
  }

  public function landlord_details()
  {
    return $this->hasOne('App\LandlordDetails');
  }
  public function landlord_web_details()
  {
    return $this->hasOne('App\LandlordWebDetails');
  }


  public static function getUserDetail($id, $page = "")
  {

    $user = self::find($id)->toArray();


    $details = UserDetails::where('user_id', '=', $id)->first();

    $landlord_details = LandlordDetails::where('user_id', '=', $id)->first();


    $web_details = LandlordWebDetails::where('landlord_id', '=', $id)->first();

    if (isset($details->id)) {
      $details = $details->toArray();
      unset($details['id']);
    } else {
      $details = [];
    }


    if (isset($landlord_details->id)) {
      $landlord_details = $landlord_details->toArray();
      unset($landlord_details['id']);
    } else {
      $landlord_details = [];
    }

    if (isset($web_details->id)) {
      $web_details = $web_details->toArray();
      unset($web_details['id']);
      if ($page == 'web') {
        if ($details) {
          unset($details['address']);
          unset($user['email']);
        }

      }
    } else {
      $web_details = [];
    }


    return array_merge($user, $details, $landlord_details, $web_details);
  }

  public static function landlords()
  {
    $landlords = User::where('role', '=', 3)->paginate(10);
    return $landlords;
  }

  public static function all_landlords()
  {
    $landlords = User::where('role', '=', 3)->get();
    return $landlords;
  }

  public static function entrata_landlords()
  {
    $landlords = User::where('role', '=', 3)->join('user_details AS u', 'u.user_id', '=', 'users.id')->join('landlord_details AS l', 'l.user_id', '=', 'users.id')->where('l.is_entrata', '=', 'Active');

    return $landlords;
  }

  public static function yardi_landlords()
  {
    $landlords = User::where('role', '=', 3)->join('user_details AS u', 'u.user_id', '=', 'users.id')->join('landlord_details AS l', 'l.user_id', '=', 'users.id')->where('l.is_yardi', '=', 'Active');

    return $landlords;
  }

  public function details()
  {
    return $this->hasOne('App\UserDetails');
  }

  public static function premium_lanlords()
  {
    $landlrods = LandlordDetails::where('domain_name', '>', '')->with('user')->get()->toArray();
    return $landlrods;
  }

  public static function company_lanlords($id)
  {

    if ($id == 0) {
      $landlrods = DB::table(env('DB_DATABASE') . '.users AS u')
        ->join('landlord_details', 'landlord_details.user_id', '=', 'u.id')
        ->where([['landlord_details.company', '<>', ''], ['u.role', '=', 3]])
        ->select('landlord_details.company', 'u.id', 'u.name', 'u.email', 'u.campus_id');

    } else {
      $landlrods = DB::table(env('DB_DATABASE') . '.users AS u')
        ->join('landlord_details', 'landlord_details.user_id', '=', 'u.id')
        ->where([['u.campus_id', '=', $id], ['landlord_details.company', '<>', ''], ['u.role', '=', 3]])
        ->select('landlord_details.company', 'u.id', 'u.name', 'u.email', 'u.campus_id');

    }
    /*->paginate(10);*/
    return $landlrods;
    /*$landlrods = LandlordDetails::where('company', '>', '')->with('user')->get()->toArray();*/
//        $landlrods = LandlordDetails::where('company', '<>', '')->with('user')->paginate(10);
    //      return $landlrods;
  }
}
