<?php

namespace App\Http\Controllers\rcpadmin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\LandlordDetails;

use Request;


class PreimumLandlordController extends Controller
{
  public function index()
  {

    $landlords = User::premium_lanlords();
    return view('rcpadmin.premium-landlord', compact('landlords'));
  }

  public function show($id)
  {
    $user = User::getUserDetail($id);
    return view('rcpadmin.premium-landlord.edit', compact('user'));

  }

  public function update($id, Requests\PremiumLandlordRequest $request)
  {

    $input = Request::all();
    $landlord_details = LandlordDetails::where('user_id', '=', $id);
    if ($landlord_details) {
      $landlordData = array(
        'homepage_h1' => $input['homepage_h1'], 'homepage_title' => $input['homepage_title'], 'homepage_description' => $input['homepage_description'],'homepage_seo_block' => $input['homepage_seo_block'],
        'homepage_h1' => $input['aboutus_h1'], 'aboutus_title' => $input['aboutus_title'], 'aboutus_description' => $input['aboutus_description'],'aboutus_seo_block' => $input['aboutus_seo_block'],
        'contactus_h1' => $input['contactus_h1'], 'contactus_title' => $input['contactus_title'], 'contactus_description' => $input['contactus_description'],'contactus_seo_block' => $input['contactus_seo_block']
        );


      $landlord_details->update($landlordData);
    }


    return redirect('rcpadmin/premium-landlord');
  }
}
