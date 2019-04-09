<?php

namespace App\Http\Controllers\rcpadmin;

use App\rcpadmin\AppView;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\GeneralHelper;
use DB;

class ScreenVisitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $screenVisits['campuses'] = GeneralHelper::getColumn('campus', 'title');
        $screenVisits['screen_v'] = DB::table('rentcp_stats_laravel.app_views')
            ->select('page_type', DB::raw('COUNT(*) as `count`'))
            ->groupBy('page_type')
            ->havingRaw('COUNT(*) > 0')
            ->get();
        return view('rcpadmin/screen-visits', compact('screenVisits'));
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
