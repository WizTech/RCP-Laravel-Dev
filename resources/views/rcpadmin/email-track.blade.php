@extends('rcpadmin.layouts.app')
@section('styles')
  <!-- Start datatable css -->
  <link rel="stylesheet" type="text/css" href="{{ env('ASSETS_PATH') }}chosen-bootstrap/chosen/chosen.css">
  <link rel="stylesheet" type="text/css" href="{{ env('ASSETS_PATH') }}css/popup.css">
  <link rel="stylesheet" type="text/css"
        href="{{ env('THEME_ASSETS_NEW') }}assets/cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css"
        href="{{ env('THEME_ASSETS_NEW') }}assets/cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" type="text/css"
        href="{{ env('THEME_ASSETS_NEW') }}assets/cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
  <link rel="stylesheet" type="text/css"
        href="{{ env('THEME_ASSETS_NEW') }}assets/cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
  <!-- style css -->
@stop
@section('breadcrumbs')
  <div class="breadcrumbs-area clearfix">
    <h4 class="page-title pull-left">Email Leads</h4>
    <ul class="breadcrumbs pull-left">
      <li><a href="{{ url('rcpadmin/').'/' }}">Dashboard</a></li>
      <li><span>Stats / </span></li>
      <li><a href="{{'rcpadmin/email-leads'}}">Email Leads</a></li>
    </ul>
  </div>
@stop
@section('content')
  <div class="row">
    <div class="col-12 mt-5">
      <div align="left">
        <form id="Export-Data"  method="post">
          {{ csrf_field() }}
          <button type="button" onclick="ajax_viewer_config('export_list', '{{url('rcpadmin/email-leads-modal')}}' );"
                  class="btn btn-success btn-lg">EXPORT LIST
          </button>
        </form>
      </div>
      <div align="right">
        <form action="{{url('rcpadmin/email-leads-export')}}" method="post">
          {{ csrf_field() }}

          <button type="submit" class="btn btn-success btn-lg"> EXPORT CURRENT LIST</button>

        </form>
      </div>
      <div align="right" style="padding-right: 15%;">
        <div class="row">

          <div class="col-md-6">
            <form action="{{url('rcpadmin/app-leads')}}" method="get">
              <select class="select-box-in" name="campus_id" id="campusId">
                <option value="All">All Campuses</option>
                @if(!empty($emailLeads['campuses']))
                  @foreach($emailLeads['campuses'] as $campus)
                    <?php if (isset($_GET['campus_id']) && $_GET['campus_id'] == $campus->id): ?>
                    <option value="{{$campus->id}}" selected>{{$campus->title}}</option>
                    <?php else: ?>
                    <option value="{{$campus->id}}">{{$campus->title}}</option>
                    <?php endif; ?>
                  @endforeach
                @endif
              </select>
            </form>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-body">
          <div class="table-responsive datatable-dark">
            <table class="text-center table">
              <thead class="text-capitalize">
              <tr>
                <th>Property</th>
                <th>Landlord</th>
                <th>Sender Name</th>
                <th>Sender Email</th>
                <th>User From</th>
                <th>Date</th>
              </tr>
              </thead>
              <tbody>
              @if(!empty($emailLeads['leads']))
                @foreach( $emailLeads['leads'] as $lead)
                  <tr>
                    <td>{{empty($lead->title) ? $lead->address : $lead->title}} </td>
                    <td>{{$lead->name}} </td>
                    <td>{{$lead->sender_name}} </td>
                    <td>{{$lead->sender_email}} </td>
                    <td>{{$lead->user_from}} </td>

                    <td>{{date("Y-m-d",strtotime($lead->date_created))}}</td>
                  </tr>
                @endforeach
              @endif
              </tbody>
            </table>
            @if(isset($emailLeads['leads']) && count($emailLeads['leads']) > 0)
              {{$emailLeads['leads']->links()}}
              Showing {{$emailLeads['leads']->firstItem()}} to {{$emailLeads['leads']->lastItem()}}
              of {{$emailLeads['leads']->total()}}
              Entities
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
  <iframe style="display: none;" id="Email-leadsIframe"></iframe>
@stop

@section('scripts')
  <!-- data-tables -->
  <script src="{{ env('ASSETS_PATH') }}chosen-bootstrap/chosen/chosen.jquery.min.js"></script>
  <script src="{{ env('ASSETS_PATH') }}js/ajax_viewer.js"></script>
  <script src="{{ env('THEME_ASSETS_NEW') }}assets/cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
  <script src="{{ env('THEME_ASSETS_NEW') }}assets/cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
  <script src="{{ env('THEME_ASSETS_NEW') }}assets/cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
  <script
    src="{{ env('THEME_ASSETS_NEW') }}assets/cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
  <script
    src="{{ env('THEME_ASSETS_NEW') }}assets/cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
  <script>
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });


    $(document).ready(function () {
      var initialized = false;
      $(function () {
        $(".datePicker").focus();
        $(".datePicker").blur(function () {
          if (!initialized) {
            $(".datePicker").datepicker({
              autoOpen: false
            });
            initialized = true;
          }
        });
      });
    });

  </script>
@stop