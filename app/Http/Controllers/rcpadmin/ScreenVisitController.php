<?php

namespace App\Http\Controllers\rcpadmin;

use App\rcpadmin\AppView;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\GeneralHelper;
use DB;
use Excel;

class ScreenVisitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $screenVisits = DB::table('rentcoll_stats.app_views')
            ->select('page_type', DB::raw('COUNT(*) as `count`'))
            ->groupBy('page_type')
            ->havingRaw('COUNT(*) > 0')
            ->get();
        return view('rcpadmin/screen-visits', compact('screenVisits'));
    }


    function screenExport()
    {
        $visit[] = ['Screen','Visits'];
        if (!empty($_GET)) {
            if ($_GET['page_type'] === 'All'){
                $screenVisits = DB::table('rentcoll_stats.app_views')
                    ->select('page_type', DB::raw('COUNT(*) as `count`'))
                    ->whereBetween('date', [$_GET['date_from'], $_GET['date_to']])
                    ->groupBy('page_type')
                    ->havingRaw('COUNT(*) > 0')
                    ->get();
            }else{
                    $screenVisits = DB::table('rentcoll_stats.app_views')
                        ->select('page_type', DB::raw('COUNT(*) as `count`'))
                        ->whereBetween('date', [$_GET['date_from'], $_GET['date_to']])
                        ->where('page_type', $_GET['page_type'])
                        ->groupBy('page_type')
                        ->havingRaw('COUNT(*) > 0')
                        ->get();
            }
            foreach ($screenVisits as $screenVisit) {
                $visit[] = array(
                    'Screen' => $screenVisit->page_type ?  $screenVisit->page_type : '',
                    'Visits' => $screenVisit->count ? $screenVisit->count : '',
                );
            }
            $sheetName  = date('d-m-y his');
            return Excel::create($sheetName, function ($excel) use ($visit) {
                $excel->setTitle('visits');
                $excel->sheet('visits', function ($sheet) use ($visit) {
                    $sheet->fromArray($visit, null, 'A1', false, false);
                });
            })->download('csv');
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
