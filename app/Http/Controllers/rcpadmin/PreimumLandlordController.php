<?php

namespace App\Http\Controllers\rcpadmin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\LandlordWebDetails;
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
        'homepage_h1' => $input['homepage_h1'], 'homepage_title' => $input['homepage_title'], 'homepage_description' => $input['homepage_description'], 'homepage_seo_block' => $input['homepage_seo_block'],
        'homepage_h1' => $input['aboutus_h1'], 'aboutus_title' => $input['aboutus_title'], 'aboutus_description' => $input['aboutus_description'], 'aboutus_seo_block' => $input['aboutus_seo_block'],
        'contactus_h1' => $input['contactus_h1'], 'contactus_title' => $input['contactus_title'], 'contactus_description' => $input['contactus_description'], 'contactus_seo_block' => $input['contactus_seo_block']
      );


      $landlord_details->update($landlordData);
    }


    return redirect('rcpadmin/premium-landlord');
  }

  public function web($id)
  {
    $user = User::getUserDetail($id, 'web');
    return view('rcpadmin.premium-landlord.web', compact('user'));

  }

  public function web_update($id, Requests\LandlordWebDetails $request)
  {

    $input = Request::all();

    $landlord_details = LandlordWebDetails::where('landlord_id', '=', $id)->first();
    $slider_image_one = $request->file('slider_image_one');

    $input['slider_image_one'] = !empty($input['slider_image_one']) ? $input['slider_image_one'] : '';
    $input['slider_image_two'] = !empty($input['slider_image_two']) ? $input['slider_image_two'] : '';
    $input['logo_top'] = !empty($input['logo_top']) ? $input['logo_top'] : '';
    $input['logo_bottom'] = !empty($input['logo_bottom']) ? $input['logo_bottom'] : '';

    if (isset($slider_image_one)) {
      $companyPath = storage_path('app/public/web/');
      $slider_image_one->move($companyPath, $slider_image_one->getClientOriginalName());


      $imageName = $slider_image_one->getClientOriginalName();
      $input['slider_image_one'] = $imageName;
    }

    $slider_image_two = $request->file('slider_image_two');
    if (isset($slider_image_two)) {
      $companyPath = storage_path('app/public/web/');
      $slider_image_two->move($companyPath, $slider_image_two->getClientOriginalName());


      $imageName = $slider_image_two->getClientOriginalName();
      $input['slider_image_two'] = $imageName;
    }

    $logo_top = $request->file('logo_top');
    if (isset($logo_top)) {
      $companyPath = storage_path('app/public/web/');
      $logo_top->move($companyPath, $logo_top->getClientOriginalName());


      $imageName = $logo_top->getClientOriginalName();
      $input['logo_top'] = $imageName;
    }

    $logo_bottom = $request->file('logo_bottom');
    if (isset($logo_bottom)) {
      $companyPath = storage_path('app/public/web/');
      $logo_bottom->move($companyPath, $logo_bottom->getClientOriginalName());


      $imageName = $logo_bottom->getClientOriginalName();
      $input['logo_bottom'] = $imageName;
    }


    $landlord_id = $input['user_id'];
    $slider_image_one = $input['slider_image_one'];
    $slider_image_two = $input['slider_image_two'];


    $logo_top = $input['logo_top'];
    $logo_bottom = $input['logo_bottom'];

    $slider_text_one = $input['slider_text_one'];
    $slider_text_two = $input['slider_text_two'];


    $address = $input['address'];
    $phone = $input['phone'];
    $email = $input['email'];


    $fb_page = $input['facebook_page'];
    $twitter_page = $input['twitter_page'];
    $instagram_page = $input['instagram_page'];


    $open_hours = $input['open_hours'];
    $about_info = $input['about_info'];

    $get_in_touch = $input['get_in_touch'];
    $specials = $input['specials'];
    $landlordData = array(
      'landlord_id' => $landlord_id,
      'logo_top' => $logo_top,
      'logo_bottom' => $logo_bottom,
      'slider_image_one' => $slider_image_one,
      'slider_image_two' => $slider_image_two,
      'slider_text_one' => $slider_text_one,
      'slider_text_two' => $slider_text_two,
      'address' => $address,
      'phone' => $phone,
      'email' => $email,
      'facebook_page' => $fb_page,
      'twitter_page' => $twitter_page,
      'instagram_page' => $instagram_page,
      'open_hours' => $open_hours,
      'about_info' => $about_info,
      'specials' => $specials,
      'get_in_touch' => $get_in_touch,
    );
    if ($landlord_details) {
      $landlord_details->update($landlordData);
    } else {
      LandlordWebDetails::create($landlordData);
    }


    return redirect('rcpadmin/premium-landlord');
  }
}
