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
        if (!empty($_GET)){
            if (!empty($_GET['page_type']) && $_GET['campus_id'] == 'All'){
                $page_type = $_GET['page_type'];
                if (!empty($page_type)) {
                    $appViews['visits'] = AppView::filter_visits($page_type,'');
                }
            }elseif(!empty($_GET['campus_id']) && $_GET['page_type'] == 'All'){
                $campus_id = $_GET['campus_id'];
                if (!empty($campus_id)) {
                    $appViews['visits'] = AppView::filter_visits('',$campus_id);
                }
            }
        }elseif(!empty($views)) {
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

    function visitExport(){
        $views = AppView::all()->toArray();
        if (!empty($views)) {
            if (!empty($_GET['date_from'] && $_GET['date_to'])){
                $date_from = $_GET['date_from'];
                $date_to = $_GET['date_to'];
                $campus_id = $_GET['campus_id'];
                $page_type = $_GET['page_type'];
                $appVisits = AppView::visitExport($date_from, $date_to, $campus_id, $page_type)->toArray();
                $visits[] = array('User Name', 'Email', 'Phone No', 'Campus Title', 'Page Type');
                foreach ($appVisits as $appVisit) {
                    $visits[] = array(
                        'User Name' => $appVisit->username,
                        'Email' => $appVisit->email,
                        'Phone No' => $appVisit->phone_no,
                        'Campus Title' => $appVisit->campus_title,
                        'Page Type' => $appVisit->page_type
                    );
                }
            }

            $sheetName  = date('d-m-y his');
            return Excel::create($sheetName, function ($excel) use ($visits) {
                $excel->setTitle('visits');
                $excel->sheet('visits', function ($sheet) use ($visits) {
                    $sheet->fromArray($visits, null, 'A1', false, false);
                });
            })->download('csv');
        }
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
