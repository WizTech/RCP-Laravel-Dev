<?php

namespace App\Http\Controllers\rcpadmin;

use App\BlockIPModel;
use App\Http\Requests;
use App\Helpers\GeneralHelper;
use App\Http\Controllers\Controller;
use Request;


class BlockIPController extends Controller
{

    protected $module;

    public function __construct()
    {
        $this->module = GeneralHelper::module_data('BlockIPController');
    }

    public function index()
    {
        $ips = BlockIPModel::paginate(10);
        return view('rcpadmin.block-ip', compact('ips'));
    }

    public function create()
    {
        return view('rcpadmin.block-ip.add');
    }

    public function store(Requests\BlockIPRequest $request)
    {

        $input = Request::all();
        $insert =BlockIPModel::create($input);

        /* Activity Log Begin */
        $module = $this->module;
        $insertedData = BlockIPModel::find($insert->id);
        $logs = "New IP Address '". $insertedData->ip . "' is blocked in ".$module->title;
        GeneralHelper::EditLogFile($module->id, $logs);
        /* Activity Log End */


        return redirect('rcpadmin/block_ip');

    }

    public function show($id)
    {
        $ip = BlockIPModel::find($id);

        return view('rcpadmin.block-ip.edit', compact('ip'));
    }

    public function update($id, Requests\BlockIPRequest $request)
    {
        $input = Request::all();
        $ip = BlockIPModel::find($id);
        $ip->update($input);


        /* Activity Log Begin */
        $module = $this->module;
        $updated_columns = $ip->getChanges();
        $afterUpdate = !empty($updated_columns) ? json_encode($updated_columns) : '';
        $data = GeneralHelper::getNameById('block_ip', 'ip', $id);
        $logs = $data . ' Updated in '.$module->title;
        GeneralHelper::EditLogFile($module->id, $logs, '', $afterUpdate);
        /* Activity Log End */


        return redirect('rcpadmin/block_ip');
    }

    public function destroy($id)
    {
        $ip = BlockIPModel::find($id);

        if ($ip) {
            $module = $this->module;
            $feature_name = GeneralHelper::getNameById('block_ip', 'ip', $id);
            $logs = $feature_name . ' Deleted from '.$module->title;
            BlockIPModel::destroy($id);
            GeneralHelper::EditLogFile($module->id, $logs);
        }
        return redirect('rcpadmin/block_ip');
    }
}
