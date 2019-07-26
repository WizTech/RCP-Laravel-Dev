<?php

namespace App\Http\Controllers\rcpadmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CareerRequest;
use App\rcpadmin\Career;
use App\rcpadmin\CareerType;
use App\Helpers\GeneralHelper;
use DB;

class CareerController extends Controller
{

    protected $module;
    public function __construct()
    {
        $this->module = GeneralHelper::module_data('CareerController');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $careers= Career::with('type')->paginate(10);
        return view('rcpadmin.career', compact('careers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $careertypes= CareerType::all()->toArray();
        return view('rcpadmin.career.add', compact('careertypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CareerRequest $form)
    {
        $insert_id = $form->saveRequest();

        /* Activity Log Begin */
        $module = $this->module;
        $insertedData = Career::find($insert_id);
        $logs = "A new Career: '". $insertedData->careers_type . "' is created";
        GeneralHelper::EditLogFile($module->id, $logs);
        /* Activity Log End */

        return redirect('rcpadmin/career');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $careers = Career::find($id);
        $career_type = CareerType::all()->toArray();
        return view('rcpadmin.career.edit', compact('careers','career_type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CareerRequest $form, $id)
    {
        $form->updateRequest($id);

        /* Activity Log Before Update Begin */
        $before= Career::find($id);
        $beforeUpdate = [
            'Careers Type' => $before['careers_type']
        ];
        /* Acitvity Log Before Updated End */

        /* Update data Using Form Request*/
        $form->updateRequest($id);
        /* Update End */

        /* Acitvity Log After Update Begin  */
        $after = Career::find($id);
        $afterUpdate = [
            'Careers Type' => $after['careers_type']
        ];

        $module = $this->module;
        $befor_change = !empty($beforeUpdate) ? json_encode($beforeUpdate) : '';
        $after_change = !empty($afterUpdate) ? json_encode($afterUpdate) : '';

        $data = GeneralHelper::getNameById('career', 'title', $id);
        $logs = "Career: '".$data . "' is Updated '";
        GeneralHelper::EditLogFile($module->id, $logs, $befor_change, $after_change);
        /* Activity Log End */

        return redirect('rcpadmin/career');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $career = Career::find($id);
        if ($career) {
            $module = $this->module;
            $data = GeneralHelper::getNameById('career', 'title', $id);
            $logs = "Career: '".$data . "' was Deleted from ".$module->title;
            Career::destroy($id);
            GeneralHelper::EditLogFile($module->id, $logs);
        }
        return redirect('rcpadmin/career');
    }
}
