<?php

namespace App\Http\Controllers\rcpadmin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\rcpadmin\RentlinxListing;
use Illuminate\Http\Request;
use App\CategoryModel;
use App\CampusModel;
use App\Property;
use App\User;

class RentlinxListingController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //AND ((address <> '' AND  address <> ', ,  ') || name <> '')
    $listings = RentlinxListing::where([['status', '=', 'deny'], ['address', '<>', ', ,  '], ['name', '<>', '']])->paginate(10);
    return view('rcpadmin/rentlinx-listing')->with('listings', $listings);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   *
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function show($rentlinx_id)
  {
    $listing['rentlinx'] = RentlinxListing::where('rentlinx_id', $rentlinx_id)->first()->toArray();
    $listing['landlord'] = User::where('role_id', 3)->get();
    $listing['campus'] = CampusModel::all();
    $listing['category'] = CategoryModel::all();
    return view('rcpadmin/rentlinx-listing/edit', compact('listing'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request $request
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $rentlinx_id = $_POST['rentlinx_id'];
    $rentID = Property::where('rentlinx_listing_id', $rentlinx_id)->first();

    if (isset($rentID)) {
      DB::table('property')
        ->where('rentlinx_listing_id', $request->rentlinx_id)
        ->update([
          'campus_id' => $request->campus_id,
          'category_id' => $request->category_id,
          'landlord_id' => $request->landlord_id,
          'title' => $request->listing_title,
          'address' => $request->address,
          'description' => $request->description,
          'email' => $request->contact_email,
          'phone' => $request->contact_phone,
          'property_expiry_date' => $request->property_expiry,
          'rentlinx_listing_id' => $request->rentlinx_id
        ]);
    } else {
      DB::table('property')->insert([
        'campus_id' => $request->campus_id,
        'category_id' => $request->category_id,
        'landlord_id' => $request->landlord_id,
        'title' => $request->listing_title,
        'address' => $request->address,
        'description' => $request->description,
        'email' => $request->contact_email,
        'phone' => $request->contact_phone,
        'property_expiry_date' => $request->property_expiry,
        'rentlinx_listing_id' => $request->rentlinx_id
      ]);
    }
    return redirect('rcpadmin/rentlinx-listing/edit-property/' . $rentlinx_id);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($rentlinx_id)
  {
    DB::table('rentlinx_listings')
      ->where('rentlinx_id', $rentlinx_id)
      ->update(['status' => 'deny']);
    return redirect('rcpadmin/unapproved');
  }

  public function editProperty($rentlinx_id)
  {
    $data['listing'] = Property::where('rentlinx_listing_id', $rentlinx_id)->first();
    $data['landlord'] = User::where('role_id', 3)->get();
    $data['campus'] = CampusModel::all();
    $data['category'] = CategoryModel::all();
    return view('rcpadmin/rentlinx-listing/edit-property', compact('data'));
  }

  public function updateProperty(Request $request, $id)
  {
    $rentID = Property::where('rentlinx_listing_id', $request->rentlinx_listing_id)->first();
    $rentlinx_id = $rentID['rentlinx_listing_id'];
    if (isset($rentID)) {
      DB::table('property')
        ->where('rentlinx_listing_id', $request->rentlinx_listing_id)
        ->update([
          'landlord_id' => $request->landlord_id,
          'campus_id' => $request->campus_id,
          'category_id' => $request->category_id,
          'status' => $request->status ? $request->status : 'Active',
          'title' => $request->listing_title,
          'units_number' => $request->units_number,
          'address' => $request->address,
          'description' => $request->description,
          'email' => $request->contact_email,
          'double_featured_ord' => $request->double_feature_ordering,
          'twilio_number' => $request->twilio_number,
          'double_feature_expiry_date' => $request->double_feature_expiry,
          'special_expiry' => $request->special_expiry,
          'property_expiry_date' => $request->property_expiry,
          'rentlinx_listing_id' => $request->rentlinx_listing_id
        ]);
    }
    return redirect('rcpadmin/rentlinx-listing/edit-campus/' . $rentlinx_id);
  }

  public function editCampus($rentlinx_id)
  {
    $data['listing'] = Property::where('rentlinx_listing_id', $rentlinx_id)->first();
    $data['landlord'] = User::where('role_id', 3)->get();
    $data['campus'] = CampusModel::all();
    $data['category'] = CategoryModel::all();
    return view('rcpadmin/rentlinx-listing/edit-campus', compact('data'));
  }

  public function updateCampus(Request $request, $id)
  {
    $rentID = Property::where('rentlinx_listing_id', $request->rentlinx_listing_id)->first();
    if (isset($rentID)) {
      DB::table('property')
        ->where('rentlinx_listing_id', $request->rentlinx_listing_id)
        ->update([
          'campus_id' => $request->campus_id,
          'category_id' => $request->category_id,
          'landlord_id' => $request->landlord_id,
          'rentlinx_listing_id' => $request->rentlinx_listing_id,
          'units_number' => $request->units_number,
          'description' => $request->description,
          'meta_title' => $request->meta_title,
          'meta_description' => $request->meta_description,
          'twilio_number' => $request->twilio_number,
          'email' => $request->contact_email,
          'phone' => $request->contact_phone,
          'special' => $request->special,
          'double_featured' => $request->double_feature ? $request->double_feature : 'Inactive',
          'special_expiry' => $request->special_expiry,
          'property_expiry_date' => $request->property_expiry,
          'status' => $request->status ? $request->status : 'Active',
        ]);
    }

    return redirect('rcpadmin/rentlinx-listing');

  }

}
