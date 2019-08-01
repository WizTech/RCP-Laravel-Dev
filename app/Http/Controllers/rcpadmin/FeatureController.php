<?php

namespace App\Http\Controllers\rcpadmin;

use App\FeatureModel;
use App\FeatureType;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Request;
use App\Helpers\GeneralHelper;

class FeatureController extends Controller
{

  protected $module;

  public function __construct()
  {
    $this->module = GeneralHelper::module_data('FeatureController');
  }

  public function index()
  {
    $features = FeatureModel::with('featureType')->paginate(10);
    return view('rcpadmin.feature', compact('features'));
  }

  public function type($id)
  {

    $features = FeatureModel::where('type', '=', $id)->with('featureType')->paginate(10);

    return view('rcpadmin.feature-list', compact('features'));
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
    $insert = FeatureModel::create($input);

    /* Activity Log Begin */
    $module = $this->module;
    $insertedData = FeatureModel::find($insert->id);
    $logs = "New Feature '" . $insertedData->name . "' Created in " . $module->title;
    GeneralHelper::EditLogFile($module->id, $logs);
    /* Activity Log End */

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

    return view('rcpadmin.feature.edit', compact('feature', 'featureTypes'));
  }

  public function update($id, Requests\FeatureRequest $request)
  {
    $input = Request::all();
    $feature = FeatureModel::find($id);
    $feature->update($input);

    /* Activity Log Begin */
    $module = $this->module;
    $updated_columns = $feature->getChanges();
    $afterUpdate = json_encode($updated_columns);
    $newFeatureName = GeneralHelper::getNameById('feature', 'name', $id);
    $logs = $newFeatureName . ' Updated in ' . $module->title;
    GeneralHelper::EditLogFile($module->id, $logs, '', $afterUpdate);
    /* Activity Log End */

    return redirect('rcpadmin/feature');
  }

  public function destroy($id)
  {
    $feature = FeatureModel::find($id);
    /*if ($feature) {
        FeatureModel::destroy($id);
    }*/
    $module = $this->module;
    $feature_name = GeneralHelper::getNameById('feature', 'name', $id);
    $logs = $feature_name . ' Deleted in ' . $module->title;
    $feature->delete();
    GeneralHelper::EditLogFile($module->id, $logs);
    return redirect('rcpadmin/feature');
  }

}
