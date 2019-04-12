<?php

namespace App\Http\Controllers\rcpadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\CampusModel;
use App\rcpadmin\MetaDetails;

class MetaDetailsController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $campuses = CampusModel::all();
    return view('rcpadmin.meta-details', compact('campuses'));
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
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $campus = CampusModel::getCampusDetail($id);
    return view('rcpadmin.meta-details.map', compact('campus'));
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


    $input = $request->all();

    $page_type = $input['submitbutton'];
    if($page_type == 'Subleases'):
      $type = 'subleases';
    elseif($page_type == 'Roommates'):
      $type = 'roommates';
    else:
      $type = 'map';
    endif;



    $input['page_type'] = $type;



    $meta_details = MetaDetails::where('campus_id', '=', $id)->first();

    if ($meta_details) {
      $meta_details->update($input);
    } else {
      MetaDetails::create($input);
    }


    return redirect('rcpadmin/meta-details');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    //
  }
}
