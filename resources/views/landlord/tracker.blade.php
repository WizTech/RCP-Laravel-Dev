@extends('landlord.layouts.app')
@section('styles')
  <!-- Start datatable css -->
  <link rel="stylesheet" type="text/css"
        href="{{ env('THEME_ASSETS_NEW') }}assets/cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css"
        href="{{ env('THEME_ASSETS_NEW') }}assets/cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" type="text/css"
        href="{{ env('THEME_ASSETS_NEW') }}assets/cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
  <link rel="stylesheet" type="text/css"
        href="{{ env('THEME_ASSETS_NEW') }}assets/cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">

  <link href="{{ env('ASSETS_PATH') }}landlord/css/xcharts.min.css?v=777"

        rel="stylesheet">

  <link href="{{ env('ASSETS_PATH') }}landlord/css/xcharts_second.min.css?v=777"

        rel="stylesheet">

  <link href="{{ env('ASSETS_PATH') }}landlord/css/style.css?v=777" rel="stylesheet">

  <link href="{{ env('ASSETS_PATH') }}landlord/css/style_second.css?v=777"

        rel="stylesheet">







  <link rel="stylesheet" type="text/css" media="all"

        href="{{ env('ASSETS_PATH') }}landlord/js/daterangepicker-bs3.css"/>

  <style>
    .details-legend {

      width: 100%;

      float: left;

      list-style-type: none;

    }

    .details-legend li {

      float: left;

      width: 25%;

    }

    .collegepads-legend {

      width: 11px;

      height: 11px;

      background: #333;

      border-radius: 100%;

      margin-right: 5px;

      display: inline-block;

      vertical-align: middle;

    }

    .padvisor-legend {

      width: 11px;

      height: 11px;

      background: #24CE61;

      border-radius: 100%;

      margin-right: 5px;

      display: inline-block;

      vertical-align: middle;

    }
  </style>
  <!-- style css -->
@stop
@section('breadcrumbs')
  <div class="breadcrumbs-area clearfix">
    <h4 class="page-title pull-left">Lead Tracker</h4>
    <ul class="breadcrumbs pull-left">
      <li><a href="{{ url('landlord/').'/' }}">Dashboard</a></li>
      <li><span>Lead Tracker</span></li>
    </ul>
  </div>
@stop
@section('content')
  @php
    $timeFormat = "m/d/Y";

    $FromDate = ((isset($_POST['date-from']) === true) ? strtotime($_POST['date-from'] . ' 00:00:00') : strtotime("- 1 week"));

    $ToDate = isset($_POST['date-to']) ? strtotime($_POST['date-to'] . ' 23:59:59') : time();
  @endphp

  <input type="hidden" id="floor_id" value="{{$pids}}">

  <input type="hidden" id="active_listing_ids" value="{{$pids}}">

  <input type="hidden" id="page_url" value="{{env('APP_URL')}}landlord/ajax">
  <input type="hidden" id="page_url_show" value="{{env('APP_URL')}}landlord/ajax_count_show">
  <input type="hidden" id="lead_page_url" value="{{env('APP_URL')}}landlord/ajax_leads">
  <input type="hidden" id="lead_page_url_show" value="{{env('APP_URL')}}landlord/ajax_count_show_lead">

  <div class="row">
    <div class="col-12 mt-5">
      <div class="card">
        <div class="card-body">

          <div class="table-responsive datatable-dark tracker-main">
            <div class="tracker-inner">

              <div class="left">

                <h2>Views</h2>

                <div class="tracker-body">

                  <form class="form-horizontal">

                    <fieldset>

                      <div class="input-prepend">

                        <span class="add-on"><i class="icon-calendar"></i></span><input type="text"

                                                                                        name="range"

                                                                                        id="range"/>

                      </div>

                    </fieldset>

                  </form>

                  <div class="tracker-visit-info result">Total Views:</div>

                  <div class="tracker-visit-info result-2">Total Views:</div>

                  <div class="tracker-visit-info result-unique">Total Unique Views:</div>

                  <div id="placeholder">

                    <figure id="chart"></figure>

                  </div>

                </div>

              </div>

              <div class="right">

                <h2>Leads</h2>

                <div class="tracker-body">

                  <form class="form-horizontal">

                    <fieldset>

                      <div class="input-prepend">

                        <span class="add-on"><i class="icon-calendar"></i></span><input type="text"

                                                                                        name="range_second"

                                                                                        id="range_second"/>

                      </div>

                    </fieldset>

                  </form>

                  <div style="padding: 20px;font-size: 16px;font-weight: bold;"

                       class="tracker-visit-info">

                    <table>

                      <tr style="color: #3880aa">

                        <td align="right">Email Leads:</td>

                        <td>

                          <div class="result1"></div>

                        </td>

                      </tr>

                      <tr style="color:#4da944">

                        <td align="right">Phone Leads:</td>

                        <td>

                          <div class="result2"></div>

                        </td>

                      </tr>

                      <tr style="color: #333;">

                        <td align="right">Padvisor Leads:</td>

                        <td>

                          <div class="result5"></div>

                        </td>

                      </tr>


                      <tr style="color: #f26522;">

                        <td align="right">Landlord Site Visits:</td>

                        <td>

                          <div class="result4"></div>

                        </td>

                      </tr>

                      <tr>

                        <td align="right">Total Leads:</td>

                        <td>

                          <div class="result3"></div>

                        </td>

                      </tr>


                    </table>

                  </div>

                  <div id="placeholder_second">

                    <figure style="height: 375px;" id="chart_second"></figure>

                  </div>

                </div>

              </div>
            </div>
          </div>
          <div class="table-responsive datatable-dark">
            <h2>Leads</h2>


            <ul class="details-legend">

              <li><span class="collegepads-legend"></span> RentCollegePads</li>

              <li><span class="padvisor-legend"></span> Padvisor</li>

            </ul>

            <form action="" method="post">
              {!! Form::token() !!}
              <div class="pull-left padding-5p">


                From <input name="date-from" value="<?= date('m/d/Y', $FromDate) ?>"

                            class="form-control date-picker" type="text">

              </div>

              <div class="pull-left padding-5p">

                To <input name="date-to" value="<?= date('m/d/Y', $ToDate) ?>"

                          class="form-control date-picker" type="text">

              </div>

              <div class="pull-left padding-5p">

                <button type="submit" style="  margin-top: 20px;" class="btn green">Update</button>

              </div>

            </form>

            <div class="clearfix"></div>

            <div class="clearfix"></div>
            <table class="text-center table">
              <thead class="text-capitalize">
              <tr>


                <th>Property</th>

                <th>Sender Name</th>

                <th>Sender Email</th>

                <th>Sender Phone</th>

                <th>Message</th>


                <th>Date</th>

              </tr>
              </thead>
              <tbody>
              @if(!empty($leads))

                @foreach($leads as $row)
                  <tr class="stat-type-{{ $row['type'] }}">


                    <td><a target="_blank"

                           href="{{ env('APP_URL') }}landlord/property/{{ $row['property_id'] }}">{{ $row['address'] }}</a>

                    </td>

                    <td>{{ $row['sendername'] }}</td>

                    <td>{{ $row['senderemail'] }}</td>

                    <td>{{ $row['contact'] }}</td>

                    <td>{{ $row['message'] }}</td>


                    <td>{{ date("m/d/Y h:iA", strtotime($row['datecreated'])) }}</td>

                  </tr>

                @endforeach
              @endif
              </tbody>
            </table>

            @if(isset($leads) && count($leads) > 0)
              {!! $paginator->links() !!}

              Showing {{$leads->firstItem()}} to {{$leads->lastItem()}}
            @endif
          </div>
          <div class="table-responsive datatable-dark">
            <h2>Landlord Site Leads</h2>
            <ul class="details-legend">

              <li><span class="collegepads-legend"></span> RentCollegePads</li>

              <li><span class="padvisor-legend"></span> Padvisor</li>

            </ul>

            <form action="" method="post">
              {!! Form::token() !!}
              <div class="pull-left padding-5p">


                From <input name="date-from" value="<?= date('m/d/Y', $FromDate) ?>"

                            class="form-control date-picker" type="text">

              </div>

              <div class="pull-left padding-5p">

                To <input name="date-to" value="<?= date('m/d/Y', $ToDate) ?>"

                          class="form-control date-picker" type="text">

              </div>

              <div class="pull-left padding-5p">

                <button type="submit" style="  margin-top: 20px;" class="btn green">Update</button>

              </div>

            </form>
            <div class="clearfix"></div>
            <table class="text-center table">
              <thead class="text-capitalize">
              <tr>


                <th>Visits</th>

                <th>Date</th>

              </tr>
              </thead>
              <tbody>
              @if(!empty($site_leads))

                @foreach($site_leads as $row)
                  <tr>

                    <td>{{ $row['counts'] }}</td>

                    <td>{{ date("m/d/Y", strtotime($row['date_created'])) }}</td>


                  </tr>

                @endforeach
              @endif
              </tbody>
            </table>
            {{--@if(isset($leads) && count($leads) > 0)
               {{$leads->links()}}
               Showing {{$leads->firstItem()}} to {{$leads->lastItem()}}
             @endif--}}
          </div>
        </div>
      </div>
    </div>
  </div>
@stop

@section('scripts')
  <!-- data-tables -->
  <script src="{{ env('THEME_ASSETS_NEW') }}assets/cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
  <script src="{{ env('THEME_ASSETS_NEW') }}assets/cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
  <script src="{{ env('THEME_ASSETS_NEW') }}assets/cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
  <!-- xcharts includes -->

  <script type="text/javascript" src="{{ env('ASSETS_PATH') }}landlord/js/moment.js"></script>



  <script src="{{ env('ASSETS_PATH') }}landlord/js/d3.v2.js"></script>

  <script src="{{ env('ASSETS_PATH') }}landlord/js/xcharts.min.js"></script>

  <script src="{{ env('ASSETS_PATH') }}landlord/js/xcharts_second.min.js"></script>

  <!-- The daterange picker bootstrap plugin -->

  <script src="{{ env('ASSETS_PATH') }}landlord/js/sugar.min.js"></script>

  <script src="{{ env('ASSETS_PATH') }}landlord/js/daterangepicker.js?v=1520"></script>

  <!-- Our main script file -->

  <script src="{{ env('ASSETS_PATH') }}landlord/js/script.js?v=777"></script>

  <script src="{{ env('ASSETS_PATH') }}landlord/js/script_second.js?v=777"></script>



  <script
    src="{{ env('THEME_ASSETS_NEW') }}assets/cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
  <script
    src="{{ env('THEME_ASSETS_NEW') }}assets/cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
  <script>
    $('.date-picker').datepicker();
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $(document).on('click', 'a.jquery-postback', function (e) {
      e.preventDefault(); // does not go through with the link.

      if (!confirm('Are you sure?')) {
        return false;
      }

      var $this = $(this);


      var id = $this.data('admin-id');

      $.ajax({

        type: "DELETE",

        url: $this.data('href'),

        data: {"id": id, "_token": "{{ csrf_token() }}"},

        success: function (result) {

          window.location.reload()
          //  console.log(result)

        }
      });

    })

  </script>
  <script>
    $('.delete').click(function () {
      return confirm("Are you sure you want to delete?");
    })
  </script>
@stop