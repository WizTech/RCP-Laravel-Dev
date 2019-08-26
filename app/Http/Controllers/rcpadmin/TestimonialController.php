<?php

namespace App\Http\Controllers\rcpadmin;

use App\rcpadmin\Testimonial;
use App\Http\Controllers\Controller;
use App\Http\Requests\TestimonialRequest;
use App\Helpers\GeneralHelper;


class TestimonialController extends Controller
{

    protected $module;
    public function __construct()
    {
        $this->module = GeneralHelper::module_data('TestimonialController');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testimonials = Testimonial::paginate(10);
        return view('rcpadmin.testimonial', compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rcpadmin.testimonial.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(TestimonialRequest $form)
    {
        $insert_id =  $form->saveRequest();

        /* Activity Log Begin */
        $module = $this->module;
        $insertedData = Testimonial::find($insert_id);
        $logs = "A new Testimonial: '". $insertedData->title . "' is created by: ".$insertedData->person_name;
        GeneralHelper::EditLogFile($module->id, $logs);
        /* Activity Log End */

        return redirect('rcpadmin/testimonials');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $testimonial = Testimonial::find($id);
        return view('rcpadmin.testimonial.edit', compact('testimonial'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function update(TestimonialRequest $form, $id)
    {
        /* Activity Log Before Update Begin */
        $before= Testimonial::find($id);
        $beforeUpdate = [
            'Person Nname' => $before['person_name'],
            'Title' =>  $before['title'],
            'Company' => $before['company'],
            'Market' => $before['market'],
            'Text' => $before['text']
        ];
        /* Acitvity Log Before Updated End */

        /* Updating data, Using Form Request*/
        $form->updateRequest($id);
        /* Update End */


        /* Acitvity Log After Update Begin  */
        $after = Testimonial::find($id);
        $afterUpdate = [
            'Person Nname' => $before['person_name'],
            'Title' =>  $before['title'],
            'Company' => $before['company'],
            'Market' => $before['market'],
            'Text' => $before['text']
        ];

        $module = $this->module;
        $befor_change = !empty($beforeUpdate) ? json_encode($beforeUpdate) : '';
        $after_change = !empty($afterUpdate) ? json_encode($afterUpdate) : '';

        $data = GeneralHelper::getNameById('testimonials', 'title', $id);
        $logs = $data . ' Testimonial Updated ';
        GeneralHelper::EditLogFile($module->id, $logs, $befor_change, $after_change);
        /* Activity Log End */

        return redirect('rcpadmin/testimonials');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $testimonial = Testimonial::find($id);
        if ($testimonial) {
            $module = $this->module;
            $data = GeneralHelper::getNameById('testimonials', 'title', $id);
            $logs = $data . ' Deleted from '.$module->title;
            Testimonial::destroy($id);
            GeneralHelper::EditLogFile($module->id, $logs);
        }

        return redirect('rcpadmin/testimonials');
    }
}
