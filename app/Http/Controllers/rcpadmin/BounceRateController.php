<?php

namespace App\Http\Controllers\rcpadmin;

use App\rcpadmin\BounceRate;
use App\Http\Controllers\Controller;
use Config;
use DB;

class BounceRateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bounceRate = DB::connection(config::get("constants.STATE_DB"))->table(config::get("constants.DB2.APP_VIEWS"))
            ->select('page_type', DB::raw('COUNT(*) as `count`'))
            ->groupBy('page_type')
            ->havingRaw('COUNT(*) > 0')
            ->paginate(10);
        return view('rcpadmin/bounce-rate', compact('bounceRate'));
    }

}
