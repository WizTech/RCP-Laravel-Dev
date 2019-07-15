<?php

namespace App\Http\Controllers\rcpadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\rcpadmin\ListContactForm;

use Excel;

class ListContactFormController extends Controller
{
  public function index()
  {
    $data = ListContactForm::paginate(10);;
    return view('rcpadmin.list-contact-form', compact('data'));
  }

  function leadExport()
    {
      if (!empty($_GET)) {
        $date_from = $_GET['date_from'];
        $date_to = $_GET['date_to'];
       
        $lead[] = ['Name','Email','Phone', 'Address', 'Fax', 'Message','Date'];
        if (true) {

          $expiredProperties = ListContactForm::lead_export($date_from, $date_to);
          foreach ($expiredProperties as $expired) {
            $lead[] = array(
              'Name' => $expired->name,
              'Email' => $expired->email,
              'Phone' => $expired->phone,
              'Address' => $expired->address,
              'Fax' => $expired->fax,
              'Message' => $expired->message,
              'Date' => $expired->add_date,
            );
          }
        }
        $sheetName = date('d-m-y his');
        return Excel::create($sheetName, function ($excel) use ($lead) {
          $excel->setTitle('Expired Property');
          $excel->sheet('expired', function ($sheet) use ($lead) {
            $sheet->fromArray($lead, null, 'A1', false, false);
          });
        })->download('csv');
      }
    }
}
