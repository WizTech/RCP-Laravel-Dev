<?php

namespace App\Http\Controllers\rcpadmin;

use App\Helpers\GeneralHelper;
use App\Http\Controllers\Controller;
use App\rcpadmin\EmailTrack;
use Excel;
use DateTime;
use App\User;

class EmailTrackController extends Controller
{
  public function index()
  {
    // $leads = EmailTrack::all()->toArray();

    $emailLeads = [];
    $emailLeads['leads'] = EmailTrack::email_leads();
    $emailLeads['campuses'] = GeneralHelper::getColumn('campus', 'title');
    if (!empty($_GET)) {
      if (isset($_GET['lead_type'])) {
        $leadType = $_GET['lead_type'];
        $leads['leads'] = EmailTrack::filter_leads($leadType, '');
        return view('rcpadmin/app-leads', compact('appLeads'));
      }
      if (isset($_GET['campus_id'])) {
        $campusId = $_GET['campus_id'];
        $leads['leads'] = EmailTrack::filter_leads('', $campusId);
        return view('rcpadmin/app-leads', compact('appLeads'));
      }
    }

    return view('rcpadmin/email-track', compact('emailLeads'));
  }

  public function export_list()
  {

    $email_leads = EmailTrack::export_list();

    $lead[] = array('Property Name', 'Landlord', 'Sender Name', 'Sender Email', 'Sender Contact', 'Sender Message', 'Date');

    if (count($email_leads) > 0) {
      foreach ($email_leads as $data) {
        $lead[] = array(
          'Property Name' => ((empty($data->address) === true && empty($data->title) === true) ? 'Submited on Landlord Profile' : ((empty($data->title) === true) ? $data->address : $data->title)),
          'Landlord' => $data->first_name . ' ' . $data->last_name,
          'Sender Name' => $data->sender_name,
          'Sender Contact' => $data->sender_contact,
          'Sender Mesage' => $data->sender_message,
          'Date' => $data->datecreated
        );
      }


    }
    $sheetName = date('d-m-y his');
    return Excel::create($sheetName, function ($excel) use ($lead) {
      $excel->setTitle('Email Leads Export List');
      $excel->sheet('email-leads-export-list', function ($sheet) use ($lead) {
        $sheet->fromArray($lead, null, 'A1', false, false);
      });
    })->download('csv');
  }

  public function exportList()
  {

    $campuses = GeneralHelper::getColumn('campus', 'title');
    $landlords = User::all_landlords();
    $company_lanlords = User::company_lanlords(0)->paginate(1000);
    $campusId = 1;
    ?>
    <style>.leads-selection label {

        display: inline-block;

      }

      .leads-selection input {

        vertical-align: text-top;

      }</style>
    <div class="row-fluid">
      <div class="span12">
        <div class="portlet box blue">
          <div class="portlet-title">
            <h4><i class="icon-list-alt"></i>Export List</h4>
          </div>
          <form id="export-form">
            <div class="portlet-body form">
              <h3 class="form-section">Leads From</h3>
              <div class="row-fluid">
                <div class="span6 ">
                  <div class="control-group">
                    <label class="control-label">Select Site</label>
                    <div class="controls">
                      <select name="select-site" class="MultiSelectAjax22" id="select-site">
                        <option value="3">All</option>
                        <option value="1">RentCollegePads.com</option>
                        <option value="2">Padvisor.com</option>
                        <option value="4">UMN</option>
                      </select>
                      <span class="help-block errorCont"></span>
                    </div>
                  </div>
                </div>
              </div>
              <h3 class="form-section">Select Leads Type</h3>
              <div class="span12 leads-selection">
                <label>
                  <input type="radio" name="leadsType" checked="" value="all"> All Leads
                </label>
                |
                <label>
                  <input type="radio" name="leadsType" value="email"> Email Leads
                </label>
                |
                <label>
                  <input type="radio" name="leadsType" value="phone"> Phone Leads
                </label>
                |
                <label>
                  <input type="radio" name="leadsType" value="leadsViews"> Active Property Leads/Views
                </label>
                |
                <label>
                  <input type="radio" name="leadsType" value="yearlyLeadsViews"> Yearly Leads/Views
                </label>
              </div>
              <h3 class="form-section">Select Date Range</h3>
              <div class="row-fluid">
                <div class="span6 ">
                  <div class="control-group">
                    <label class="control-label">Date From</label>
                    <div class="controls">
                      <input type="text" name="DateFrom" class="m-wrap span12 DatePickerAjax datePicker"
                             placeholder="Date From">
                      <span class="help-block errorCont"></span>
                    </div>
                  </div>
                </div>

                <div class="span6 ">
                  <div class="control-group">
                    <label class="control-label">Date To</label>
                    <div class="controls">
                      <input type="text" name="DateTo" class="m-wrap span12 DatePickerAjax datePicker"
                             placeholder="Date To">
                      <span class="help-block errorCont"></span>
                    </div>
                  </div>
                </div>

              </div>
              <div class="row-fluid">
                <div class="span6 ">
                  <div class="control-group">
                    <label class="control-label">Campus (if select none, it will select all
                      campus)</label>
                    <div class="controls" id="st-slect">
                      <style>

                        #st-slect .chzn-container {

                          width: 100% !important;

                        }

                        #st-slect .chzn-drop {

                          width: 100% !important;

                        }

                        #st-slect .chzn-search input {

                          width: 95% !important;

                        }

                      </style>
                      <select multiple="" name="campusAjax[]" class="MultiSelectCampusAjax">
                        <?php
                        if ($campuses):
                          foreach ($campuses as $campus):
                            ?>
                            <option value="<?php echo $campus->id; ?>"><?php echo $campus->title; ?></option>
                            <?php
                          endforeach;
                        endif;
                        ?>
                      </select>
                      <span class="help-block errorCont"></span>
                      <div class="clearfix"></div>
                    </div>
                  </div>
                </div>

                <div class="span6 ">
                  <div class="control-group">
                    <label class="control-label">Landlord (if select none, it will select all
                      Landlord)</label>
                    <div class="controls" id="st-slect">
                      <select multiple="" name="LandlordAjax[]" class="MultiSelectAjax landlordDropdown">
                        <?php
                        if ($landlords):
                          foreach ($landlords as $landlord):
                            ?>
                            <option value="<?php echo $landlord['id']; ?>"><?php echo $landlord['name']; ?></option>
                            <?php
                          endforeach;
                        endif;
                        ?>
                        <!-- <option data-user-id="" value="83">Hannah Kimyon</option>

                         <option data-user-id="" value="128832">Phil Kilpatrick</option>-->
                      </select>
                      <span class="help-block errorCont"></span>
                    </div>
                  </div>
                </div>

              </div>
              <div class=" row-fluid">
                <div class="span6 ">
                  <div class="control-group">
                    <label class="control-label">Company</label>
                    <div class="controls" id="st-slect">
                      <select multiple="" name="companyAjax[]" class="MultiSelectAjax companyDropdown">
                        <?php
                        if ($company_lanlords):
                          foreach ($company_lanlords as $landlord):
                            ?>
                            <option value="<?php echo $landlord->id; ?>"><?php echo $landlord->name; ?></option>
                            <?php
                          endforeach;
                        endif;
                        ?>
                        <!--<option value="Madison Property Management">Madison Property Management</option>
                        <option value="The University of Oklahoma">The University of Oklahoma</option>-->
                      </select>
                      <span class="help-block errorCont"></span>
                    </div>
                  </div>
                </div>
                <div class="span6 ">
                  <div class="control-group">
                    <label class="control-label">Username</label>
                    <div class="controls" id="st-slect">
                      <select multiple="" name="usernameAjax[]" class="MultiSelectAjax usernameDropdown">
                        <?php
                        if ($landlords):
                          foreach ($landlords as $landlord):
                            ?>
                            <option value="<?php echo $landlord['id']; ?>"><?php echo $landlord['name']; ?></option>
                            <?php
                          endforeach;
                        endif;
                        ?>
                        <!--<option value="MPM">MPM</option>-->

                      </select>
                      <span class="help-block errorCont"></span>
                    </div>
                  </div>
                </div>

                <div class="hidden span6 ">
                  <div class="control-group">
                    <label class="control-label">Bedrooms (if select none, it will select all
                      Bedrooms)</label>
                    <div class="controls" id="st-slect">
                      <select multiple="" name="bedrooms[]" class="MultiSelectAjax bedrooms">
                        <option value="0">Studio</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                      </select>
                      <span class="help-block errorCont"></span>
                    </div>
                  </div>
                </div>

              </div>
              <div id="Response-props">
              </div>
              <div id="ExportFile"></div>
              <input id="submit-File-Btn" type="SUBMIT" value="Export"><br>
              <div style="width: 200px;position: relative;height: 30px;display:none ;;text-align: center;"
                   id="loadingere" class="progress">
        <span style="        font-size: 14px;

                                        padding: 5px;

                                        display: inline-block;

                                        z-index: 9;

                                        position: absolute;

                                        right: 10px;

                                        color: #ccc;">5%</span>
                <div style="position: absolute;height: 100%;top: 0px;left: 0px;background-color: green;"></div>
              </div>
              <img style="display: none;" width="40" id="loader-file"
                   src="https://www.rentcollegepads.com/rcpadmin/assets/images/ajaxLoading.gif">
            </div>
          </form>
        </div>
      </div>
    </div>

    <script>

      jQuery.browser = {};
      (function () {
        jQuery.browser.msie = false;
        jQuery.browser.version = 0;
        if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
          jQuery.browser.msie = true;
          jQuery.browser.version = RegExp.$1;
        }
      })();
      jQuery(document).ready(function () {

        $('.DatePickerAjax').datepicker({dateFormat: 'yy-mm-dd'});
        $('.MultiSelectAjax').chosen();

        $('.MultiSelectCampusAjax').chosen({max_selected_options: 1});

        $('#export-form').submit(function (e) {

          e.preventDefault();

          $('#loader-file').show();

          var data = $('#export-form').serialize();

          var dummyTime = 100;

          var InterValCounter = 0;

          interval = setInterval(function () {

            InterValCounter++;

            if (InterValCounter > 95) {

              return false;

            }

            var percent = InterValCounter;//InterValCounter/dummyTime*100;

            $('#loadingere').show().children('span').text(percent + "%").next().css('width', percent + '%');

          }, 800);

          var url = '<?=env('ADMIN_URL')?>/all-leads-export';


          $.ajax({

            url: url,

            data: data,//{serialize_data: data, url: url, type: type, date: date_range},

            type: 'POST',

            dataType: "text",

            cache: false,

            complete: function () {

              clearInterval(interval);

              $('#loadingere').show().children('span').text("100%").next().css('width', '100%');


            },

            success: function (res) {

              $('#loadingere').hide();

              if (res !== '') {

                //$('#ExportFile').html('<a href="'+res+'" class="btn green" target="_blank">Download File</a>');

                setTimeout(function () {

                  $('#ExportFile').html('');

                }, 5000);

                //$('#ExportFile a').click();

                //$('#Email-leadsIframe').attr('src', res);

                //$('#submit-File-Btn').hide();


                // Checking if Browser is Safair


                console.log(navigator.userAgent)


              } else {

                $('#ExportFile').html('Email Leads Not Found.');

              }

              $('#loader-file').hide();


            }

          });

        });
      });
    </script>
    <?php
  }

  public function export_leads()
  {
    ini_set('max_execution_time', 0);

    set_time_limit(0);

    ini_set('memory_limit', '-1');

    $leadsType = $_REQUEST['leadsType'];

    $_REQUEST['DateFromO'] = $_REQUEST['DateFrom'];


    $date = new DateTime($_REQUEST['DateFrom']);

    $date->modify('-1 day');


    $dateFromm = $_REQUEST['DateFrom'];

    $dateToo = $_REQUEST['DateTo'];


    $_REQUEST['DateFrom'] = (empty($_REQUEST['DateFrom']) === false) ? $date->format('Y-m-d') . ' 24:00:00' : '';

    $_REQUEST['DateTo'] = (empty($_REQUEST['DateTo']) === false) ? $_REQUEST['DateTo'] . ' 23:59:59' : '';


    $leadsType = $_REQUEST['leadsType'];

    $selectSite = $_REQUEST['select-site'];

    /*Campus Filter*/
    if (isset($_REQUEST['campusAjax'])) {

      $selectCampusIDs = $_REQUEST['campusAjax'];

      //$whereClause = [];

      foreach ($selectCampusIDs as $campID) {
        $whereClause = ['campus_id', '=', $campID];
        $campusLinkedData = GeneralHelper::getColumnByKeyValue('campus_linked', 'campus_linked', $whereClause);

        $linkeCampuses = array();

        foreach ($campusLinkedData as $campusDataLinked) {

          $linkeCampuses[] = $campusDataLinked->campus_linked;

        }
        echo '<pre>';
        print_r($linkeCampuses);
        echo '</pre>';

      }


    }
    /*Campus Filter*/


    /*company Filter*/
    $company_users = array();

    if (isset($_REQUEST['companyAjax'])) {

      $companies = $_REQUEST['companyAjax'];


      foreach ($companies as $company) {

        // $whereClause = ['company', '=', $company];
//         $companyData = GeneralHelper::getColumnUsingJoin('landlord_details', 'user_id', $whereClause);
        $companyData = GeneralHelper::getColumnById('users', 'id', $company);
        foreach ($companyData as $data) {

          $company_users[] = $data->user_id;

        }


      }


    }
    /*company Filter*/

    /*Username Filter */

    $landlordsByUsername = array();

    if (isset($_REQUEST['usernameAjax'])) {

      $landlordUsernames = $_REQUEST['usernameAjax'];
      foreach ($landlordUsernames as $landlordUsers) {
        $landlordUserData = GeneralHelper::getColumnById('users', 'id', $landlordUsers);
        foreach ($landlordUserData as $ludata) {

          $landlordsByUsername[] = $ludata->id;

        }


      }


    } /*Username Filter */


    if ($leadsType == 'email') {

      $query = "
   
                 SELECT
   
                   SELECT-COLUMN
   
                   et.property_id,
   
                   et.sender_message,
   
                   et.sender_contact,
   
                   et.sender_email,
   
                   et.sender_name,
   
                   '' AS is_lead_type,
   
                   et.sender_ip,
   
                   et.user_from,
   
                   et.lead_type,
   
                   et.banner_lead,
    et.schedule_lead,
                   et.schedule_date,
                   et.schedule_time,
                   et.leads_for,
                   et.bedrooms,
   
                   et.email_status,
   
                   et.read_timestamp,
   
                   u.first_name,
   
                   u.last_name,
   
                   u.username,
   
                   et.date_created AS datecreated,
   
                   pp.address as address,
   
                   pp.category_id,
   
                   camp.title AS campus_title
   
                 FROM
   
                 " . env('DB_DATABASE2') . ".`email_track` et
   
                 INNER-JOIN
   
                 INNER JOIN `users` u
   
                     ON u.`id` = et.`user_id`
   
                 INNER JOIN `property` pp ON pp.`id` = et.`property_id`
   
                 INNER JOIN `campus` camp ON camp.`id` = pp.`campus_id`
   
                             INNER-BEDRROMS-JOIN
   
     
   
                      ";

    } else if ($leadsType == 'phone') {

      $query = "
   
                 SELECT
   
                   SELECT-COLUMN
   
                    et.property_id AS property_id,
   
                   et.phone as sender_contact,
   
                   et.email as sender_email,
   
                   et.name as sender_name,
   
                   et.sender_ip,
   
                   et.user_from,
   
                   et.is_lead_type AS is_lead_type,
   
                   et.banner_lead,
           'No' AS schedule_lead,
                    'N/A' AS schedule_date,
                     'N/A' AS schedule_time,
     et.leads_for,
                   u.first_name,
   
                   u.last_name,
   
                   u.username,
   
                   et.date_created AS datecreated,
   
                   pp.address as address,
   
                   pp.category_id,
   
                   camp.title  AS campus_title
   
                 FROM
   
                 " . env('DB_DATABASE2') . ".`phone_leads` et
   
                 INNER-JOIN
   
                 INNER JOIN `users` u
   
                     ON u.`id` = et.`landlord_id`
   
                 INNER JOIN `property` pp ON pp.`id` = et.`property_id`
   
                 INNER JOIN `campus` camp ON camp.`id` = pp.`campus_id`
   
                             INNER-BEDRROMS-JOIN
   
     
   
     
   
                      ";

    } else if ($leadsType == 'all') {

      $query1 = "
   
                     SELECT
   
                     SELECT-COLUMN
   
                      pl.property_id AS property_id,
   
                     pl.phone AS sender_contact,
   
                     pl.email AS sender_email,
   
                     pl.name AS sender_name,
   
                     'PHONE LEAD' AS sender_message,
   
                     pl.sender_ip,
   
                    pl.user_from,
   
                    pl.is_lead_type AS is_lead_type,
   
                    'Original' as lead_type,
   
                    pl.banner_lead,
                       'No' AS schedule_lead,
                    'N/A' AS schedule_date,
                     'N/A' AS schedule_time,
     pl.leads_for,
                     pl.bedrooms,
   
                     '--Call--' AS email_status,
   
                     '' AS read_timestamp,
   
                     u.first_name,
   
                     u.last_name,
   
                     u.username,
   
                     pl.date_created AS datecreated,
   
                     pp.address AS address,
   
                     pp.category_id,
   
                     camp.title  AS campus_title
   
                     FROM
   
                     " . env('DB_DATABASE2') . ".`phone_leads` pl
   
     
   
     
   
                     INNER-JOIN
   
     
   
                     INNER JOIN `users` u
   
                     ON u.`id` = pl.`landlord_id`
   
                     INNER JOIN `property` pp
   
                     ON pp.`id` = pl.`property_id`
   
                     INNER JOIN `campus` camp ON camp.`id` = pp.`campus_id`
   
     
   
                     INNER-BEDRROMS-JOIN
   
     
   
     
   
                          ";

      $query2 = "
   
                    UNION ALL
   
                    SELECT
   
                    SELECT-COLUMN
   
                     et.property_id AS property_id,
   
                    et.sender_contact,
   
                    et.sender_email,
   
                    et.sender_name,
   
                    et.sender_message,
   
                    et.sender_ip,
   
                      et.user_from,
   
                   '' AS is_lead_type,
   
                      et.lead_type,
   
                      et.banner_lead,
                        et.schedule_lead,
                   et.schedule_date,
                   et.schedule_time,
   et.leads_for,
                    et.bedrooms,
   
                    et.email_status,
   
                    et.read_timestamp,
   
                    u.first_name,
   
                    u.last_name,
   
                    u.username,
   
                    et.date_created AS datecreated,
   
                    pp.address AS address,
   
                    pp.category_id,
   
                    camp.title  AS campus_title
   
                    FROM
   
                    " . env('DB_DATABASE2') . ".`email_track` et
   
                    INNER-JOIN
   
                    INNER JOIN `users` u
   
                    ON u.`id` = et.`user_id`
   
                    INNER JOIN `property` pp
   
                    ON pp.`id` = et.`property_id`
   
                    INNER JOIN `campus` camp ON camp.`id` = pp.`campus_id`
   
     
   
                    INNER-BEDRROMS-JOIN
   
     
   
                    ";

    }

    if ($leadsType == 'all') {

      $where_flag = false;

      if (empty($_REQUEST['DateFrom']) === false && empty($_REQUEST['DateTo']) === false) {

        $where_flag = true;

        $_REQUEST['date'] = " Date Range : " . $_REQUEST['DateFrom'] . ' - ' . $_REQUEST['DateTo'];

        $query1 .= "WHERE  pl.`date` BETWEEN '" . $_REQUEST['DateFrom'] . "' AND '" . $_REQUEST['DateTo'] . "' ";

        $query2 .= "WHERE  et.`date_created` BETWEEN '" . $_REQUEST['DateFrom'] . "' AND '" . $_REQUEST['DateTo'] . "' ";

      }

      if (isset($_REQUEST['list_selection'])) {

        if ($where_flag) {

          $query1 .= ' AND ';

          $query2 .= ' AND ';

        } else {

          $query1 .= ' WHERE ';

          $query2 .= ' WHERE ';

          $where_flag = true;

        }

        $list_selection = implode(',', $_REQUEST['list_selection']);

        $query1 .= "  pl.`id` IN($list_selection)";

        $query2 .= "  pl.`id` IN($list_selection)";

      } else {

        if (isset($_REQUEST['campusAjax']) && !isset($_REQUEST['LandlordAjax'])) {

          $merged_campuses = array_merge($_REQUEST['campusAjax'], $linkeCampuses);

          $campuses = implode(',', $merged_campuses);

          $append_query1 = " INNER JOIN `property` pli ON pli.`campus_id` IN ($campuses) AND pli.id = pl.property_id";

          $append_query2 = " INNER JOIN `property` pli ON pli.`campus_id` IN ($campuses) AND pli.id = et.property_id";

          $query1 = str_ireplace("INNER-JOIN", $append_query1, $query1);

          $query2 = str_ireplace("INNER-JOIN", $append_query2, $query2);

        } else if (!isset($_REQUEST['campusAjax']) && isset($_REQUEST['LandlordAjax'])) {

          if ($where_flag) {

            $query1 .= ' AND ';

            $query2 .= ' AND ';

          } else {

            $query1 .= ' WHERE ';

            $query2 .= ' WHERE ';

            $where_flag = true;

          }

          $landlords = implode(',', $_REQUEST['LandlordAjax']);

          $query1 .= " pl.`landlord_id` IN ($landlords) ";

          $query2 .= " et.`user_id` IN ($landlords) ";

        } else if (isset($_REQUEST['campusAjax']) && isset($_REQUEST['LandlordAjax'])) {

          $landlords = implode(',', $_REQUEST['LandlordAjax']);

          $merged_campuses = array_merge($_REQUEST['campusAjax'], $linkeCampuses);

          $campuses = implode(',', $merged_campuses);

          $append_query1 = " INNER JOIN `property` pli ON pli.`campus_id` IN ($campuses) AND pli.`user_id` IN ($landlords) AND pli.id = pl.property_id";

          $append_query2 = " INNER JOIN `property` pli ON pli.`campus_id` IN ($campuses) AND pli.`user_id` IN ($landlords) AND pli.id = et.property_id";

          $query1 = str_ireplace("INNER-JOIN", $append_query1, $query1);

          $query2 = str_ireplace("INNER-JOIN", $append_query2, $query2);


        } else if (!empty($company_users)) {

          if ($where_flag) {

            $query1 .= ' AND ';

            $query2 .= ' AND ';

          } else {

            $query1 .= ' WHERE ';

            $query2 .= ' WHERE ';

            $where_flag = true;

          }

          $company_landlords = implode(',', $company_users);

          $query1 .= " pl.`landlord_id` IN ($company_landlords) ";

          $query2 .= " et.`user_id` IN ($company_landlords) ";

        } else if (!empty($landlordsByUsername)) {

          if ($where_flag) {

            $query1 .= ' AND ';

            $query2 .= ' AND ';

          } else {

            $query1 .= ' WHERE ';

            $query2 .= ' WHERE ';

            $where_flag = true;

          }

          $username_landlords = implode(',', $landlordsByUsername);

          $query1 .= " pl.`landlord_id` IN ($username_landlords) ";

          $query2 .= " et.`user_id` IN ($username_landlords) ";

        }

      }

      // $query = "SELECT * FROM ( " . $query1 . $query2 . " ) AS data ORDER BY first_name";

      // $query = str_ireplace(array("INNER-JOIN", "SELECT-COLUMN"), '', $query);

    } else if ($leadsType == 'phone') {

      $where_flag = false;

      if (empty($_REQUEST['DateFrom']) === false && empty($_REQUEST['DateTo']) === false) {

        $where_flag = true;

        $_REQUEST['date'] = " Date Range : " . $_REQUEST['DateFrom'] . ' - ' . $_REQUEST['DateTo'];

        $query .= "WHERE  et.`date` BETWEEN '" . $_REQUEST['DateFrom'] . "' AND '" . $_REQUEST['DateTo'] . "' ";

      } else {

        //$query .= " INNER JOIN ".DB_STATS."`email_track` et ON et.`property_id` = pl.`id` ";

      }


      if (isset($_REQUEST['list_selection'])) {

        if ($where_flag) {

          $query .= ' AND ';

        } else {

          $query .= ' WHERE ';

          $where_flag = true;

        }

        $list_selection = implode(',', $_REQUEST['list_selection']);

        $query .= "  pl.`id` IN($list_selection)";

      } else {

        if (isset($_REQUEST['campusAjax']) && !isset($_REQUEST['LandlordAjax'])) {

          //if($where_flag){$query .=' AND ';} else {$query .= ' WHERE ';$where_flag=true;}

          $merged_campuses = array_merge($_REQUEST['campusAjax'], $linkeCampuses);

          $campuses = implode(',', $merged_campuses);

          //$query .= " pl.`campus_id` IN ($campuses) ";

          $append_query = " INNER JOIN `property` pl ON pl.`campus_id` IN ($campuses) AND pl.id = et.property_id";

          $query = str_ireplace("INNER-JOIN", $append_query, $query);

          $query = str_ireplace("SELECT-COLUMN", 'pl.address as address,pl.title,', $query);

        } else if (!isset($_REQUEST['campusAjax']) && isset($_REQUEST['LandlordAjax'])) {

          if ($where_flag) {

            $query .= ' AND ';

          } else {

            $query .= ' WHERE ';

            $where_flag = true;

          }

          $landlords = implode(',', $_REQUEST['LandlordAjax']);

          $query .= " u.`id` IN ($landlords) ";

        } else if (isset($_REQUEST['campusAjax']) && isset($_REQUEST['LandlordAjax'])) {

          if ($where_flag) {

            $query .= ' AND ';

          } else {

            $query .= ' WHERE ';

            $where_flag = true;

          }

          $landlords = implode(',', $_REQUEST['LandlordAjax']);

          $merged_campuses = array_merge($_REQUEST['campusAjax'], $linkeCampuses);

          $campuses = implode(',', $merged_campuses);

          $query .= " u.`id` IN ($landlords) ";

          $append_query = " INNER JOIN `property` pl ON pl.`campus_id` IN ($campuses) AND pl.id = et.property_id";

          $query = str_ireplace("INNER-JOIN", $append_query, $query);

          $query = str_ireplace("SELECT-COLUMN", 'pl.address as address,pl.title,', $query);

        } else if (!empty($company_users)) {

          if ($where_flag) {

            $query .= ' AND ';


          } else {

            $query .= ' WHERE ';


            $where_flag = true;

          }

          $company_landlords = implode(',', $company_users);

          $query .= " u.`id` IN ($company_landlords) ";


        } else if (!empty($landlordsByUsername)) {

          if ($where_flag) {

            $query .= ' AND ';


          } else {

            $query .= ' WHERE ';


            $where_flag = true;

          }

          $username_landlords = implode(',', $landlordsByUsername);

          $query .= " u.`id` IN ($username_landlords) ";


        }

      }

      $query = str_ireplace(array("INNER-JOIN", "SELECT-COLUMN"), '', $query);

      $query .= " ORDER BY u.first_name";//, pl.title,pl.address ASC

    } else {

      $where_flag = false;

      if (empty($_REQUEST['DateFrom']) === false && empty($_REQUEST['DateTo']) === false) {

        $where_flag = true;

        $_REQUEST['date'] = " Date Range : " . $_REQUEST['DateFrom'] . ' - ' . $_REQUEST['DateTo'];

        $query .= "WHERE  et.`date_created` BETWEEN '" . $_REQUEST['DateFrom'] . "' AND '" . $_REQUEST['DateTo'] . "' ";

      } else {

        //$query .= " INNER JOIN ".DB_STATS."`email_track` et ON et.`property_id` = pl.`id` ";

      }


      if (isset($_REQUEST['list_selection'])) {

        if ($where_flag) {

          $query .= ' AND ';

        } else {

          $query .= ' WHERE ';

          $where_flag = true;

        }

        $list_selection = implode(',', $_REQUEST['list_selection']);

        $query .= "  pl.`id` IN($list_selection)";

      } else {

        if (isset($_REQUEST['campusAjax']) && !isset($_REQUEST['LandlordAjax'])) {

          //if($where_flag){$query .=' AND ';} else {$query .= ' WHERE ';$where_flag=true;}

          $merged_campuses = array_merge($_REQUEST['campusAjax'], $linkeCampuses);

          $campuses = implode(',', $merged_campuses);

          //$query .= " pl.`campus_id` IN ($campuses) ";

          $append_query = " INNER JOIN `property` pl ON pl.`campus_id` IN ($campuses) AND pl.id = et.property_id";

          $query = str_ireplace("INNER-JOIN", $append_query, $query);

          $query = str_ireplace("SELECT-COLUMN", 'pl.address as address,pl.title,', $query);

        } else if (!isset($_REQUEST['campusAjax']) && isset($_REQUEST['LandlordAjax'])) {

          if ($where_flag) {

            $query .= ' AND ';

          } else {

            $query .= ' WHERE ';

            $where_flag = true;

          }

          $landlords = implode(',', $_REQUEST['LandlordAjax']);

          $query .= " et.`user_id` IN ($landlords) ";

        } else if (isset($_REQUEST['campusAjax']) && isset($_REQUEST['LandlordAjax'])) {

          if ($where_flag) {

            $query .= ' AND ';

          } else {

            $query .= ' WHERE ';

            $where_flag = true;

          }

          $landlords = implode(',', $_REQUEST['LandlordAjax']);

          $merged_campuses = array_merge($_REQUEST['campusAjax'], $linkeCampuses);

          $campuses = implode(',', $merged_campuses);

          $query .= " et.`user_id` IN ($landlords) ";

          $append_query = " INNER JOIN `property` pl ON pl.`campus_id` IN ($campuses) AND pl.id = et.property_id";

          $query = str_ireplace("INNER-JOIN", $append_query, $query);

          $query = str_ireplace("SELECT-COLUMN", 'pl.address as address,pl.title,', $query);

        } else if (!empty($company_users)) {

          if ($where_flag) {

            $query .= ' AND ';

          } else {

            $query .= ' WHERE ';

            $where_flag = true;

          }

          $company_landlords = implode(',', $company_users);


          $query .= " et.`user_id` IN ($company_landlords) ";

        } else if (!empty($landlordsByUsername)) {

          if ($where_flag) {

            $query .= ' AND ';

          } else {

            $query .= ' WHERE ';

            $where_flag = true;

          }

          $username_landlords = implode(',', $landlordsByUsername);


          $query .= " et.`user_id` IN ($username_landlords) ";

        }

      }


      $query .= " ORDER BY u.first_name";//, pl.title,pl.address ASC

    }

    if (isset($_POST['bedrooms'][0])) {

      $imp_beds = implode(",", $_POST['bedrooms']);

      $bedroomsQry1 = " INNER JOIN `property` pf1 ON pp.`id` = pf1.`listing_id` AND pf1.`rooms` IN(" . $imp_beds . ")";

      $bedroomsQry2 = " INNER JOIN `property` pf2 ON pp.`id` = pf2.`listing_id` AND pf2.`rooms` IN(" . $imp_beds . ")";

      $query = str_ireplace("INNER-BEDRROMS-JOIN", $bedroomsQry1, $query);

      $query = str_ireplace("INNER-BEDRROMS-JOIN2", $bedroomsQry2, $query);

    }

    $query = str_ireplace(array("INNER-JOIN", "SELECT-COLUMN", "INNER-BEDRROMS-JOIN2", "INNER-BEDRROMS-JOIN"), '', $query);

    /*echo '<pre>';
    print_r($query);
    echo '</pre>';*/

    $email_leads = GeneralHelper::selectQuery($query);
    $property_category = GeneralHelper::selectQuery("SELECT * FROM `category`");

    $categories = array();

    foreach ($property_category as $cat) {

      $categories[$cat->id] = $cat->name;

    }

    echo '<pre>';print_r($categories );echo '</pre>';
    echo '<pre>';print_r($email_leads );echo '</pre>';
  }
}
