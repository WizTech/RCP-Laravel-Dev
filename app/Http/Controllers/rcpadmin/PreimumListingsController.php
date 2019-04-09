<?php

namespace App\Http\Controllers\rcpadmin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Property;

use Request;


class PreimumListingsController extends Controller
{
  public function index()
  {

    $listings = Property::premium_listings();
    return view('rcpadmin.premium-listings', compact('listings'));
  }

  public function show($id)
  {
    $property = Property::find($id);
    return view('rcpadmin.premium-listings.edit', compact('property'));

  }

  public function update($id)
  {

    $input = Request::all();

    $property = Property::where('id', '=', $id);
    if ($property) {
      $propertyData = array(
        'homepage_h1' => $input['homepage_h1'], 'homepage_h2' => $input['homepage_h2'], 'homepage_description' => $input['homepage_description'],
        'neighborhood_h1' => $input['neighborhood_h1'], 'neighborhood_h2' => $input['neighborhood_h2'], 'neighborhood_description' => $input['neighborhood_description']
      );


      $property->update($propertyData);
    }


    return redirect('rcpadmin/premium-listings');
  }
}
