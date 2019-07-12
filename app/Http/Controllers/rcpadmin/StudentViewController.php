<?php

namespace App\Http\Controllers\rcpadmin;

use App\rcpadmin\StudentView;
use App\Http\Controllers\Controller;
use App\Helpers\GeneralHelper;
use Excel;


class StudentViewController extends Controller
{
  public function index()
  {
   // $leads = EmailTrack::all()->toArray();
    $studentViews = [];
    $studentViews['campuses'] = GeneralHelper::getColumn('campus', 'title');

    $studentViews['leads'] = StudentView::student_views();



    return view('rcpadmin/student-views', compact('studentViews'));
  }
}
