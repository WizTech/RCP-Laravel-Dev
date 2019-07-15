<?php

namespace App\Http\Controllers\rcpadmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CareerRequest;
use App\rcpadmin\Career;
use App\rcpadmin\CareerType;

class CareerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
<<<<<<< HEAD
        $careers= Career::paginate(10);
=======
        $careers= Career::with('type')->paginate(10);
>>>>>>> master
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
        $form->saveRequest();
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
        $news = Career::find($id);
        $news->delete();
        return redirect('rcpadmin/career');
    }
}
