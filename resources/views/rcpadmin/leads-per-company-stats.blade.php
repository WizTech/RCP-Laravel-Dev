@extends('rcpadmin.layouts.app')
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
  <!-- style css -->
@stop
@section('breadcrumbs')
  <div class="breadcrumbs-area clearfix">
    <h4 class="page-title pull-left">Leads Per Company</h4>
    <ul class="breadcrumbs pull-left">
      <li><a href="{{ url('rcpadmin/').'/' }}">Dashboard</a></li>
      <li><span>Leads Per Company</span></li>
    </ul>
  </div>
@stop
@section('content')

  <div class="row">
    <div class="col-12 mt-5">
      <div align="left">
        <form action="{{url('rcpadmin/company-leads-export')}}" method="post">
          {{ csrf_field() }}
          <input type="hidden" name="campusId" value="{{$campusId}}">
          Date From <input type="text" name="date_from" value="<?= date("Y-m-d", strtotime("-3 days")) ?>"
                           class="filter-box datePicker">
          To <input type="text" name="date_to" value="<?= date("Y-m-d") ?>" class="filter-box datePicker">

          <button type="submit" class="btn btn-success btn-lg"> EXPORT LEEDS</button>
        </form>
      </div>
      <div class="card">
        <div class="card-body">

          <div class="data-tables datatable-dark">
            <table class="text-center table">
              <thead class="text-capitalize">
              <tr>
                <th>Company</th>

                <th>Email Leads</th>
                <th>Phone Leads</th>
                {{--                            <th>Twilio Leads</th>--}}
                <th>Total Leads</th>
                <th>Total Views</th>

              </tr>
              </thead>
              <tbody>
              @if(count($companyData) > 0)
                @foreach($companyData as $cData)
                  <tr>
                    <td> {{$cData['name']}} </td>
                    <td> {{$cData['leads']['email_leads']}}</td>
                    <td> {{$cData['leads']['phone_leads']}}</td>
                    <td> {{$cData['leads']['email_leads'] + $cData['leads']['phone_leads']}} </td>
                    <td> {{$cData['views'][0]->totalViews}} </td>

                  </tr>
                @endforeach
              @endif
              </tbody>
            </table>
            @if(isset($landlords) && count($landlords) > 0)
              {{$landlords->links()}}
              Showing {{$landlords->firstItem()}} to {{$landlords->lastItem()}} of {{$landlords->total()}}
              Entities
            @endif
          </div>
        </div>
      </div>
    </div>

  </div>

@stop

@section('scripts')
  <!-- data-tables -->
  <!-- data-tables -->
  <script src="{{ env('THEME_ASSETS_NEW') }}assets/cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
  <script src="{{ env('THEME_ASSETS_NEW') }}assets/cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
  <script src="{{ env('THEME_ASSETS_NEW') }}assets/cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
  <script
    src="{{ env('THEME_ASSETS_NEW') }}assets/cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
  <script
    src="{{ env('THEME_ASSETS_NEW') }}assets/cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>

@stop