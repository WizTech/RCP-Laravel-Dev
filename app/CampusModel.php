<?php

namespace App;

use App\AdminUser;
use App\User;
use App\LinkedCampusModel;
use App\CampusGuideModel;
use App\CampusRentingQuestion;
use App\CampusNeighborhood;
use App\CampusDestination;
use App\Property;
use App\CampusApartment;
use App\rcpadmin\MetaDetails;

use Illuminate\Database\Eloquent\Model;

class CampusModel extends Model
{
  protected $table = 'campus';
  protected $fillable = [
    'name', 'title', 'address', 'meta_title', 'meta_description', 'seo_block', 'h1', 'h2', 'lat', 'lng', 'live', 'status', 'rating', 'premium_banner', 'featured_landlord'
  ];

  public function users()
  {
    return $this->belongsToMany('App\User', 'user_campuses');
  }

  public function linked_campuses()
  {
    return $this->hasMany('App\LinkedCampusModel', 'campus_linked');
  }

  public function admin_users()
  {
    return $this->belongsToMany('App\AdminUser', 'admin_campuses');
  }

  public function guide()
  {
    return $this->hasOne('App\CampusGuideModel');
  }

  public function apartment()
  {
    return $this->hasOne('App\CampusApartment');
  }

  public function neighborhood()
  {
    return $this->belongsToMany('App\CampusNeighborhood', 'campus_neighborhood', 'campus_id');
  }

  public function renting()
  {
    return $this->belongsToMany('App\CampusRentingQuestion', 'campus_renting_question', 'campus_id');
  }

  public function destination()
  {
    return $this->belongsToMany('App\CampusDestination', 'campus_destination', 'campus_id');
  }
  public function metaDetails()
  {
    return $this->belongsToMany('App\rcpadmin\MetaDetails', 'meta_details', 'campus_id');
  }

  public static function getCampusDetail($id)
  {
    $campus = self::find($id)->toArray();


    $guide_details = CampusGuideModel::where('campus_id', '=', $id)->first();
    if (isset($guide_details->id)) {
      $guide_details = $guide_details->toArray();
      unset($guide_details['id']);
    } else {
      $guide_details = [];
    }


    return array_merge($campus, $guide_details);
  }
  public static function getCampusMetaDetails($id)
  {


    $meta_details = MetaDetails::where('campus_id', '=', $id)->get()->toArray();


    return $meta_details;
  }

  public static function getCampusApartmentDetail($id)
  {
    $campus = self::find($id)->pluck('id')->toArray();

    $campus['id'] = $id;
    $campus['campus_id'] = $id;

    $apartment_details = CampusApartment::where('campus_id', '=', $id)->first();
    if (isset($apartment_details->id)) {
      $apartment_details = $apartment_details->toArray();
      unset($apartment_details['id']);
    } else {
      $apartment_details = [];
    }

    return array_merge($campus, $apartment_details);
  }

  public static function getRentingDetail($id)
  {
    $campus = self::find($id)->toArray();


    $guide_details = CampusRentingQuestion::where('campus_id', '=', $id)->get()->toArray();


    return $guide_details;
  }

  public static function getNeighborhoodDetail($id)
  {
    $campus = self::find($id)->toArray();
    unset($campus['title']);
    unset($campus['name']);

    $guide_details = CampusNeighborhood::where('campus_id', '=', $id)->get()->toArray();


    return $guide_details;
  }

  public static function getDestinationDetail($id)
  {
    $campus = self::find($id)->toArray();

    unset($campus['lat']);
    unset($campus['lng']);
    unset($campus['address']);
    unset($campus['name']);
    $guide_details = CampusDestination::where('campus_id', '=', $id)->get()->toArray();


    return $guide_details;
  }

  public function properites()
  {
    return $this->hasMany('App\Property');
  }
}
