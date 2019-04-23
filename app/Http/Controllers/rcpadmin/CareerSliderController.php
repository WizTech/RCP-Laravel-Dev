<?php

namespace App\Http\Controllers\rcpadmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CareerSliderRequest;
use App\rcpadmin\CareerSlider;

class CareerSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $career_sliders = CareerSlider::paginate(10);
        return view('rcpadmin.careerslider', compact('career_sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rcpadmin.career-slider.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CareerSliderRequest $form)
    {
        $form->saveRequest();
        return redirect('rcpadmin/careerslider');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $careerslider = CareerSlider::find($id);
        return view('rcpadmin.career-slider.edit', compact('careerslider'));
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
    public function update(CareerSliderRequest $form, $id)
    {
        $form->updateRequest($id);
        return redirect('rcpadmin/careerslider');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $careerslider = CareerSlider::find($id);
        $careerslider->delete();
        return redirect('rcpadmin/careerslider');
    }
}
