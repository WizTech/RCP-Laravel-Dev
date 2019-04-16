<?php

namespace App\Http\Controllers\rcpadmin;

use App\rcpadmin\AppFavorite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\GeneralHelper;
use Excel;

class AppFavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $favorites = AppFavorite::all()->toArray();
        $appFavorites['campuses'] = GeneralHelper::getColumn('campus', 'title');
        if (!empty($favorites)) {
            $appFavorites['favs'] = AppFavorite::app_favourite();
        }
        return view('rcpadmin/app-favorites', compact('appFavorites'));
    }

    function favroiteExport()
    {
        $fav[] = ['Campus Title', 'Property Title', 'User Name', 'Email', 'Phone No'];
        if (!empty($_GET)) {
            $date_from = $_GET['date_from'];
            $date_to = $_GET['date_to'];
            $campus_id = $_GET['campus'];
            $favorites = AppFavorite::all()->toArray();
            if (!empty($favorites)) {
                $appFavorites = AppFavorite::fav_export($date_from, $date_to, $campus_id);
            }
            foreach ($appFavorites as $screenVisit) {
                $fav[] = array(
                    'Campus Title' => $screenVisit->campus_title ?  $screenVisit->campus_title : '',
                    'Property Title' => $screenVisit->property_title ? $screenVisit->property_title : '',
                    'User Name' => $screenVisit->username ? $screenVisit->username : '',
                    'Email' => $screenVisit->email ? $screenVisit->email : '',
                    'Phone No' => $screenVisit->phone_no ? $screenVisit->phone_no : '',
                );
            }
            $sheetName  = date('d-m-y his');
            return Excel::create($sheetName, function ($excel) use ($fav) {
                $excel->setTitle('fav');
                $excel->sheet('fav', function ($sheet) use ($fav) {
                    $sheet->fromArray($fav, null, 'A1', false, false);
                });
            })->download('csv');
        }
    }

}
