<?php

namespace App\Http\Controllers\rcpadmin;

use App\rcpadmin\CareerType;
use App\Http\Controllers\Controller;
use App\Http\Requests\CareerTypeRequest;


class CareerTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $career_types = CareerType::all()->toArray();
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
        $form->saveRequest();
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
        $form->updateRequest($id);
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
        $news = CareerType::find($id);
        $news->delete();
        return redirect('rcpadmin/careertype');
    }
}
