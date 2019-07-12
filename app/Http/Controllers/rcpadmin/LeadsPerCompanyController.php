<?php

namespace App\Http\Controllers\rcpadmin;

use App\Property;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\rcpadmin\LeadsPerCompany;
use App\CampusModel;
use App\User;
use Excel;

class LeadsPerCompanyController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $campuses = CampusModel::paginate(10);

    return view('rcpadmin.leads-per-company-list', compact('campuses'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $landlords = User::company_lanlords($id)->paginate(10);
    $companyData = array();
    foreach ($landlords as $landlord) {

      $pids = Property::landlord_lisitngs($landlord->id);

      if (empty($pids[0]->ids)) {
        $pids[0]->ids = 0;
      }

      $ids = rtrim($pids[0]->ids, ',');
      $views = LeadsPerCompany::views($ids);
      $leads = LeadsPerCompany::leads($ids, $landlord->id);
      $companyData[$landlord->id]['name'] = $landlord->company;
      $companyData[$landlord->id]['views'] = $views;
      $companyData[$landlord->id]['leads'] = $leads;


    }

    $campusId = $id;

    return view('rcpadmin.leads-per-company-stats', compact('companyData', 'landlords', 'campusId'));
  }

  public function export_list()
  {

    if (isset($_POST['campusId']) && !empty($_POST['campusId'])) {

      $id = $_POST['campusId'];

      if (isset($_POST['date_from']) && empty($_POST['date_from']) === false) {

        $date_from = $dateFrom = $_POST['date_from'] . ' 00:00:00';

        $date_to = (empty($_REQUEST['date_to']) === false) ? $_REQUEST['date_to'] . ' 23:59:59' : date('Y-m-d', strtotime('+1 Day'));


      }
      $landlords = User::company_lanlords($id)->get();
      $companyData = array();
      foreach ($landlords as $landlord) {

        $pids = Property::landlord_lisitngs($landlord->id);

        if (empty($pids[0]->ids)) {
          $pids[0]->ids = 0;
        }

        $ids = rtrim($pids[0]->ids, ',');
        $views = LeadsPerCompany::views($ids, $date_from, $date_to);
        $leads = LeadsPerCompany::leads($ids, $landlord->id, $date_from, $date_to);
        $companyData[$landlord->id]['name'] = $landlord->company;
        $companyData[$landlord->id]['views'] = $views;
        $companyData[$landlord->id]['leads'] = $leads;


      }
    }

    $lead[] = array('Company', 'Email Leads', 'Phone Leads', 'Total Leads', 'Total Views');

    if (count($companyData) > 0) {
      foreach ($companyData as $cData) {
        $lead[] = array(
          'Company' => $cData['name'],
          'Email Leads' => $cData['leads']['email_leads'],
          'Phone Leads' => $cData['leads']['phone_leads'],
          'Total Leads' => $cData['leads']['email_leads'] + $cData['leads']['phone_leads'],
          'Total Views' => $cData['views'][0]->totalViews
        );
      }


    }
    $sheetName = date('d-m-y his');
    return Excel::create($sheetName, function ($excel) use ($lead) {
      $excel->setTitle('Company Leads');
      $excel->sheet('company-leads', function ($sheet) use ($lead) {
        $sheet->fromArray($lead, null, 'A1', false, false);
      });
    })->download('csv');
  }

}
