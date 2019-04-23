<?php

namespace App\Http\Controllers\rcpadmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResourceRequest;
use App\rcpadmin\Resource;
use App\CampusModel;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campus = CampusModel::paginate(10);
        return view('rcpadmin.resources', compact('campus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function createResource($id)
    {
        $campus_id = $id;
        return view('rcpadmin.resources.add', compact('campus_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ResourceRequest $form)
    {
        $form->saveRequest();
        return redirect('rcpadmin/resources');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $resources = Resource::find($id);
        return view('rcpadmin.resources.edit', compact('resources'));
    }

    public function showResource($id)
    {
        $campus = CampusModel::find($id);
        $campus_id = $campus['id'];
        $resources['campus_id'] = $campus_id;
        $resources['res'] = Resource::where('campus_id', $campus_id)->paginate(10);
        return view('rcpadmin.resources.resource-list', compact('resources'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ResourceRequest $form, $id)
    {
        $form->updateRequest($id);
        return redirect('rcpadmin/resources');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function deleteResource($id){
        $resource = Resource::find($id);
        $resource->delete();
        return redirect('rcpadmin/resources');
    }
}
