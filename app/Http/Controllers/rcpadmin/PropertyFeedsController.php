<?php

namespace App\Http\Controllers\rcpadmin;

use App\Property;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\rcpadmin\PropertyFeeds;
use App\Helpers\GeneralHelper;
use Excel;
class PropertyFeedsController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $feeds = PropertyFeeds::feeds();

    return view('rcpadmin.property-feeds', compact('feeds'));
  }

  public function export_list()
  {

    $feeds = PropertyFeeds::export_list();


    $lead[] = array('Listing ID', 'Listing name', 'No Of visits', 'Campus name', 'Final URL', 'Image URL', 'City name', 'Description', 'Price', 'Bedrooms', 'Property type', 'Listing type', 'Contextual keywords', 'Address', 'IP Address','Destination URL');
    if (count($feeds) > 0) {
      foreach ($feeds as $data) {
        $lead[] = array(

          "Listing ID" => $data->listing_id,

          "Listing name" => base64_decode($data->listing_name),

          "No Of visits" => $data->cnt,

          "Campus name" => $data->campus_title,

          "Final URL" => $data->final_url,

          "Image URL" =>  $data->image_url,

          "City name" => $data->city_name,

          "Description" => strip_tags(str_ireplace(array("<br>", "<br/>"), "\r\n", base64_decode($data->description))),

          "Price" => $data->price,

          "Bedrooms" => 1,

          "Property type" =>  $data->property_type,


          "Listing type" => $data->listing_type,

          "Contextual keywords" => $data->contextual_keywords,

          "Address" =>  $data->address,

          "IP Address" =>   $data->ip_address,

          /*"Tracking template" =>  $data->tracking_template,*/

         /* "Custom parameter" =>  $data->custom_parameter,*/

          "Destination URL" => $data->destination_url
        );
      }


    }

  //  echo '<pre>';print_r($lead );echo '</pre>';die('Call');
    $sheetName = date('d-m-y his');
    return Excel::create($sheetName, function ($excel) use ($lead) {
      $excel->setTitle('Feeds Export List');
      $excel->sheet('feeds-export-list', function ($sheet) use ($lead) {
        $sheet->fromArray($lead, null, 'A1', false, false);
      });
    })->download('csv');
  }

}
