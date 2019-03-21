<?php

namespace App\Http\Controllers\rcpadmin;

use App\FeatureModel;
use App\FeatureType;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Request;

class FeatureController extends Controller
{
  public function index()
  {
    $features = FeatureModel::with('type')->get()->toArray();
    //echo '<pre>';print_r($features );echo '</pre>';die('Call');
    return view('rcpadmin.feature', compact('features'));
  }

  public function create()
  {
    $types = FeatureType::all()->toArray();
    $featureTypes = [];

    $featureTypes[''] = 'Feature Type';
    foreach ($types as $type) {
      $featureTypes[$type['id']] = $type['name'];
    }
    return view('rcpadmin.feature.add', compact('featureTypes'));
  }

  public function store(Requests\FeatureRequest $request)
  {

    $input = Request::all();


    FeatureModel::create($input);

    return redirect('rcpadmin/feature');

  }

  public function show($id)
  {
    $feature = FeatureModel::find($id);
    $types = FeatureType::all()->toArray();
    $featureTypes = [];

    $featureTypes[''] = 'Feature Type';
    foreach ($types as $type) {
      $featureTypes[$type['id']] = $type['name'];
    }

    return view('rcpadmin.feature.edit', compact('feature','featureTypes'));
  }

  public function update($id, Requests\FeatureRequest $request)
  {
    $input = Request::all();
    $feature = FeatureModel::find($id);
    $feature->update($input);
    return redirect('rcpadmin/feature');
  }

  public function destroy()
  {
    $input = Request::all();

    $id = $input['id'];

    $feature = FeatureModel::find($id);

    if ($feature) {
      FeatureModel::destroy($id);
    }
    return 'true';
    // return redirect('rcpadmin/admin_users');
  }
}
