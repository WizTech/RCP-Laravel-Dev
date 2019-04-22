<?php

namespace App\Http\Controllers\rcpadmin;

use App\Http\Controllers\Controller;
use DB;
use Excel;
use Config;

class ScreenVisitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $screenVisits = DB::connection(config::get("constants.STATE_DB"))->table(config::get("constants.DB2.APP_VIEWS"))
            ->select('page_type', DB::raw('COUNT(*) as `count`'))
            ->groupBy('page_type')
            ->havingRaw('COUNT(*) > 0')
            ->paginate(10);
        return view('rcpadmin/screen-visits', compact('screenVisits'));
    }


    function screenExport()
    {
        $visit[] = ['Screen', 'Visits'];
        if (!empty($_GET)) {
            if ($_GET['page_type'] === 'All') {
                $screenVisits = DB::connection(config::get("constants.STATE_DB"))->table(config::get("constants.DB2.APP_VIEWS"))
                    ->select('page_type', DB::raw('COUNT(*) as `count`'))
                    ->whereBetween('date', [$_GET['date_from'], $_GET['date_to']])
                    ->groupBy('page_type')
                    ->havingRaw('COUNT(*) > 0')
                    ->get();
            } else {
                $screenVisits = DB::connection(config::get("constants.STATE_DB"))->table(config::get("constants.DB2.APP_VIEWS"))
                    ->select('page_type', DB::raw('COUNT(*) as `count`'))
                    ->whereBetween('date', [$_GET['date_from'], $_GET['date_to']])
                    ->where('page_type', $_GET['page_type'])
                    ->groupBy('page_type')
                    ->havingRaw('COUNT(*) > 0')
                    ->get();
            }
            foreach ($screenVisits as $screenVisit) {
                $visit[] = array(
                    'Screen' => $screenVisit->page_type ? $screenVisit->page_type : '',
                    'Visits' => $screenVisit->count ? $screenVisit->count : '',
                );
            }
            $sheetName = date('d-m-y his');
            return Excel::create($sheetName, function ($excel) use ($visit) {
                $excel->setTitle('visits');
                $excel->sheet('visits', function ($sheet) use ($visit) {
                    $sheet->fromArray($visit, null, 'A1', false, false);
                });
            })->download('csv');
        }
    }

}
