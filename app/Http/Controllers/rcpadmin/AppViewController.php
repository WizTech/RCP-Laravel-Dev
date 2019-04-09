<?php

namespace App\Http\Controllers\rcpadmin;

use App\rcpadmin\AppView;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\GeneralHelper;
use Illuminate\Pagination\Paginator;
use DB;
use Excel;


class AppViewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $views = AppView::all()->toArray();
        $appViews['campuses'] = GeneralHelper::getColumn('campus', 'title');
        $appViews['campuses'];
        if (!empty($views)) {
            $appViews['visits'] = AppView::app_views();
        }
        return view('rcpadmin/app-views', compact('appViews'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    function create()
    {
        //
    }

    function csvExport()
    {
        $views = AppView::all()->toArray();
        if (!empty($views)) {
            $appViews = AppView::app_views();
            $customer_data = $appViews->toArray();
            $customer_array[] = array('User Name', 'Email', 'Phone No', 'Campus Title', 'Page Type');
            foreach ($customer_data as $customer) {
                $customer_array[] = array(
                    'User Name' => $customer->username,
                    'Email' => $customer->email,
                    'Phone No' => $customer->phone_no,
                    'Campus Title' => $customer->campus_title,
                    'Page Type' => $customer->page_type
                );
            }
            $sheetName  = date('d-m-y his');
            return Excel::create($sheetName, function ($excel) use ($customer_array) {
                $excel->setTitle('visits');
                $excel->sheet('visits', function ($sheet) use ($customer_array) {
                    $sheet->fromArray($customer_array, null, 'A1', false, false);
                });
            })->download('csv');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
