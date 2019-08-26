<?php

namespace App\Http\Controllers\rcpadmin;

/*use Illuminate\Http\Request;*/

use App\TemplateModel;
use App\Http\Requests;
use App\Helpers\GeneralHelper;
use App\Http\Controllers\Controller;
use Request;
use Validator;



class TemplateController extends Controller
{

    protected $module;
    public function __construct()
    {
        $this->module = GeneralHelper::module_data('TemplateController');
    }

    public function index()
    {
        $templates = TemplateModel::paginate(10);
        return view('rcpadmin.template', compact('templates'));
    }

    public function create()
    {
        return view('rcpadmin.template.add');
    }

    public function store(Requests\TemplateRequest $request)
    {
        $input = Request::all();
        $insert = TemplateModel::create($input);

        /* Activity Log Begin */
        $module = $this->module;
        $insertedData = TemplateModel::find($insert->id);
        $logs = "New Template '". $insertedData->name . "' Created in ".$module->title;
        GeneralHelper::EditLogFile($module->id, $logs);
        /* Activity Log End */

        return redirect('rcpadmin/template');
    }

    public function show($id)
    {
        $template = TemplateModel::find($id);

        return view('rcpadmin.template.edit', compact('template'));
    }

    public function update($id, Requests\TemplateRequest $request)
    {
        $input = Request::all();
        $template = TemplateModel::find($id);
        $template->update($input);

        /* Activity Log Begin */
        $module = $this->module;
        $updated_columns = $template->getChanges();
        $afterUpdate = json_encode($updated_columns);
        $newTemplate = GeneralHelper::getNameById('template', 'name', $id);
        $logs = $newTemplate . ' Updated in '.$module->title;
        GeneralHelper::EditLogFile($module->id, $logs, '', $afterUpdate);
        /* Activity Log End */

        return redirect('rcpadmin/template');
    }

    public function destroy($id)
    {
        $price = TemplateModel::find($id);
        if ($price) {
            $module = $this->module;
            $template_name = GeneralHelper::getNameById('template', 'name', $id);
            $logs = $template_name . ' Deleted from '.$module->title;
            $template = TemplateModel::destroy($id);
            GeneralHelper::EditLogFile($module->id, $logs);
        }
        return redirect('rcpadmin/template');
    }

}
