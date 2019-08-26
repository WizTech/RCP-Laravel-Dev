<?php

namespace App\Http\Controllers\rcpadmin;

/*use Illuminate\Http\Request;*/

use App\PriceModel;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Request;
use Validator;
use App\Helpers\GeneralHelper;

class PriceController extends Controller
{
    protected $module;
    public function __construct()
    {
        $this->module = GeneralHelper::module_data('PriceController');
    }
    public function index()
    {
        $price = PriceModel::paginate(10);
        return view('rcpadmin.price', compact('price'));
    }

    public function create()
    {
        return view('rcpadmin.price.add');
    }

    public function store(Requests\PriceRequest $request)
    {

        $input = Request::all();
        $insert = PriceModel::create($input);

        /* Activity Log Begin */
        $module = $this->module;
        $insertedData = PriceModel::find($insert->id);
        $logs = "New Price '". $insertedData->name . "' Created in ".$module->title;
        GeneralHelper::EditLogFile($module->id, $logs);
        /* Activity Log End */

        return redirect('rcpadmin/price');

    }

    public function show($id)
    {
        $price = PriceModel::find($id);
        return view('rcpadmin.price.edit', compact('price'));
    }

    public function update($id, Requests\PriceRequest $request)
    {
        $input = Request::all();
        $price = PriceModel::find($id);
        $price->update($input);

        /* Activity Log Begin */
        $module = $this->module;
        $updated_columns = $price->getChanges();
        $afterUpdate = json_encode($updated_columns);
        $name_updated = GeneralHelper::getNameById('feature', 'name', $id);
        $logs = $name_updated .' Updated '.$module->title;
        GeneralHelper::EditLogFile($module->id, $logs, '', $afterUpdate);
        /* Activity Log End */

        return redirect('rcpadmin/price');
    }

    public function destroy($id)
    {
        $price = PriceModel::find($id);
        $module = $this->module;
        $deleted_item = GeneralHelper::getNameById('price', 'name', $id);
        $logs = $deleted_item . ' Deleted in '.$module->title;
        $price->delete();
        GeneralHelper::EditLogFile($module->id, $logs);

        return redirect('rcpadmin/price');
    }
}
