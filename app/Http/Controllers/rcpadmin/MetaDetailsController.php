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
    $details = CampusModel::getCampusMetaDetails($id);
    $campusId = $id;

    return view('rcpadmin.meta-details.map', compact('details','campusId'));
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
    $campus = CampusModel::find($id);
    $meta_details = MetaDetails::where('campus_id', '=', $id)->first();

    if ($meta_details) {
      $campus->metaDetails()->detach();
    }
    $i = 0;
    foreach ($input['page_type'] as $page_type) {
      $meta_title = $input['meta_title'][$i];
      $meta_keywords = $input['meta_keywords'][$i];
      $meta_description = $input['meta_description'][$i];
      MetaDetails::create(['campus_id' => $id, 'page_type' => $page_type, 'meta_title' => $meta_title, 'meta_keywords' => $meta_keywords, 'meta_description' => $meta_description]);
      $i++;
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
