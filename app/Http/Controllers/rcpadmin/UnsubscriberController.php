<?php

namespace App\Http\Controllers\rcpadmin;

use App\UnsubscriberModel;
use App\Http\Requests;
use App\Helpers\GeneralHelper;
use App\Http\Controllers\Controller;
use Request;

class UnsubscriberController extends Controller
{
    protected $module;
    public function __construct()
    {
        $this->module = GeneralHelper::module_data('UnsubscriberController');
    }

    public function index()
    {
        $emails = UnsubscriberModel::paginate(10);
        return view('rcpadmin.unsubscribers', compact('emails'));
    }

    public function create()
    {
        return view('rcpadmin.unsubcribers.add');
    }

    public function store(Requests\BlockEmailRequest $request)
    {
        $input = Request::all();
        $insert = UnsubscriberModel::create($input);

        /* Activity Log Begin */
        $module = $this->module;
        $insertedData = UnsubscriberModel::find($insert->id);
        $logs = "Email: '". $insertedData->email . "' is unsubscribed in ";
        GeneralHelper::EditLogFile($module->id, $logs);
        /* Activity Log End */

        return redirect('rcpadmin/unsubcribers');

    }

    public function show($id)
    {
        $email = UnsubscriberModel::find($id);

        return view('rcpadmin.unsubcribers.edit', compact('email'));
    }

    public function update($id, Requests\BlockEmailRequest $request)
    {
        $input = Request::all();
        $email = UnsubscriberModel::find($id);
        $email->update($input);

        /* Activity Log Begin */
        $module = $this->module;
        $updated_columns = $email->getChanges();
        $afterUpdate = !empty($updated_columns) ? json_encode($updated_columns) : '';
        $data = GeneralHelper::getNameById('unsubscribers', 'email', $id);
        $logs = $data . ' Updated in '.$module->title;
        GeneralHelper::EditLogFile($module->id, $logs, '', $afterUpdate);
        /* Activity Log End */

        return redirect('rcpadmin/unsubcribers');
    }


    public function destroy($id)
    {
        $email = UnsubscriberModel::find($id);

        if ($email) {
            $module = $this->module;
            $data = GeneralHelper::getNameById('unsubscribers', 'email', $id);
            $logs = $data . ' Deleted from '.$module->title;
            UnsubscriberModel::destroy($id);
            GeneralHelper::EditLogFile($module->id, $logs);
        }

        return redirect('rcpadmin/unsubcribers');
    }

}
