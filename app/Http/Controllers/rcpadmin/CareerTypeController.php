<?php

namespace App\Http\Controllers\rcpadmin;

use App\rcpadmin\CareerType;
use App\Helpers\GeneralHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\CareerTypeRequest;
use DB;

class CareerTypeController extends Controller
{

    protected $module;
    public function __construct()
    {
        $this->module = GeneralHelper::module_data('CareerTypeController');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $career_types = CareerType::paginate(10);
        return view('rcpadmin.careertype', compact('career_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rcpadmin.careertype.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CareerTypeRequest $form)
    {
        $insert_id = $form->saveRequest();

        /* Activity Log Begin */
        $module = $this->module;
        $insertedData = CareerType::find($insert_id);
        $logs = "A new Career Type: '". $insertedData->careers_type . "' is created";
        GeneralHelper::EditLogFile($module->id, $logs);
        /* Activity Log End */

        return redirect('rcpadmin/careertype');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $careertype = CareerType::find($id);
        return view('rcpadmin.careertype.edit', compact('careertype'));
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
    public function update(CareerTypeRequest $form, $id)
    {
        /* Activity Log Before Update Begin */
        $before= CareerType::find($id);
        $beforeUpdate = [
            'Careers Type' => $before['careers_type']
        ];
        /* Acitvity Log Before Updated End */

        /* Update data Using Form Request*/
        $form->updateRequest($id);
        /* Update End */

        /* Acitvity Log After Update Begin  */
        $after = CareerType::find($id);
        $afterUpdate = [
            'Careers Type' => $after['careers_type']
        ];

        $module = $this->module;
        $befor_change = !empty($beforeUpdate) ? json_encode($beforeUpdate) : '';
        $after_change = !empty($afterUpdate) ? json_encode($afterUpdate) : '';

        $data = GeneralHelper::getNameById('career_type', 'careers_type', $id);
        $logs = "Career Type: '".$data . "' is Updated '";
        GeneralHelper::EditLogFile($module->id, $logs, $befor_change, $after_change);
        /* Activity Log End */

        return redirect('rcpadmin/careertype');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $career_type = CareerType::find($id);

        if ($career_type) {
            $module = $this->module;
            $data = GeneralHelper::getNameById('career_type', 'careers_type', $id);
            $logs = "Career Type: '".$data . "' was Deleted from ".$module->title;
            CareerType::destroy($id);
            GeneralHelper::EditLogFile($module->id, $logs);
        }

        return redirect('rcpadmin/careertype');
    }
}
