<?php

namespace App\Http\Controllers\rcpadmin;

use App\rcpadmin\CampusInsight;
use App\CampusModel;
use App\Http\Requests\CampusInsightRequest;
use App\Http\Controllers\Controller;


class CampusInsightController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campus= CampusInsight::paginate(10);
        return view('rcpadmin.campus_insight', compact('campus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $campus= CampusModel::all()->toArray();
        return view('rcpadmin.campus-insight.add', compact('campus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CampusInsightRequest $form)
    {
        $form->saveRequest();
        return redirect('rcpadmin/campus-insight');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $campusInight['campus_insight'] = CampusInsight::find($id);
        $campusInight['campus_list']= CampusModel::all()->toArray();
        /*$file = $campusInight['campus_insight']['pdf_file'];
        if ($file)
        {
            $file = File::get('storage/uploads/campusinsight/'.$file);
            $response = Response::make($file, 200);
            $finalFile = $response->header('Content-Type', 'application/pdf');
            $campusInight['file'] = $finalFile;
        }*/
        return view('rcpadmin.campus-insight.edit', compact('campusInight'));
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
    public function update(CampusInsightRequest $form, $id)
    {
        $form->updateRequest($id);
        return redirect('rcpadmin/campus-insight');
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
