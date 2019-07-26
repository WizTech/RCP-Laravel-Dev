<?php

namespace App\Http\Controllers\rcpadmin;

use App\Http\Requests;
use App\BlockEmailModel;
use App\Helpers\GeneralHelper;
use App\Http\Controllers\Controller;
use Request;
use DB;

class BlockEmailController extends Controller
{
    protected $module;

    public function __construct()
    {
        $this->module = GeneralHelper::module_data('BlockEmailController');
    }

    public function index()
    {
        $emails = BlockEmailModel::paginate(10);
        return view('rcpadmin.block-email', compact('emails'));
    }

    public function create()
    {
        return view('rcpadmin.block-email.add');
    }

    public function store(Requests\BlockEmailRequest $request)
    {
        $input = Request::all();
        $insert = BlockEmailModel::create($input);


        /* Activity Log Begin */
        $module = $this->module;
        $insertedData = BlockEmailModel::find($insert->id);
        $logs = "Email:  '". $insertedData->email . "' has Blocked in ".$module->title;
        GeneralHelper::EditLogFile($module->id, $logs);
        /* Activity Log End */

        return redirect('rcpadmin/block_email');

    }

    public function show($id)
    {
        $email = BlockEmailModel::find($id);

        return view('rcpadmin.block-email.edit', compact('email'));
    }

    public function update($id, Requests\BlockEmailRequest $request)
    {
        $input = Request::all();
        $email = BlockEmailModel::find($id);
        $email->update($input);

        /* Activity Log Begin */
        $module = $this->module;
        $updated_columns = $email->getChanges();
        $afterUpdate = !empty($updated_columns) ? json_encode($updated_columns) : '';
        $data = GeneralHelper::getNameById('block_emails', 'email', $id);
        $logs = $data. ' Updated in '.$module->title;
        GeneralHelper::EditLogFile($module->id, $logs, '', $afterUpdate);
        /* Activity Log End */

        return redirect('rcpadmin/block_email');
    }

    public function destroy($id)
    {
        $email = BlockEmailModel::find($id);

        if ($email) {
            $module = $this->module;
            $data = GeneralHelper::getNameById('block_emails', 'email', $id);
            $logs = $data . ' Deleted from '.$module->title;
            BlockEmailModel::destroy($id);
            GeneralHelper::EditLogFile($module->id, $logs);
        }

        return redirect('rcpadmin/block_email');
    }
}
