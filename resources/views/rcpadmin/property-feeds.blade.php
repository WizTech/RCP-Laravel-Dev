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
    <h4 class="page-title pull-left">Property Feeds</h4>
    <ul class="breadcrumbs pull-left">
      <li><a href="{{ url('rcpadmin/').'/' }}">Dashboard</a></li>
      <li><span>Property Feeds</span></li>
    </ul>
  </div>
@stop
@section('content')

  <div class="row">

    <div class="col-12 mt-5">
      <div align="left">
        <form action="{{url('rcpadmin/property-feeds-export')}}" method="post">
          {{ csrf_field() }}
          Date From <input type="text" name="date_from" value="<?= date("Y-m-d", strtotime("-3 days")) ?>"
                           class="filter-box datePicker">
          To <input type="text" name="date_to" value="<?= date("Y-m-d") ?>" class="filter-box datePicker">

          <button type="submit" class="btn btn-success btn-lg"> EXPORT FEEDS</button>
        </form>
      </div>
      <div class="card">
        <div class="card-body">

          <div class="data-tables datatable-dark">
            <table class="text-center table">
              <thead class="text-capitalize">
              <tr>
                <th>Listing ID</th>
                <th>Listing Name</th>
                <th>Address</th>
                <th>Campus Name</th>
                <th>IP Address</th>
                <!--<th>IP</th>-->
                <th>Views Count<br>(in a session)</th>
                <th>Date</th>
              </tr>
              </thead>
              <tbody>
              @if(count($feeds) > 0)
                @foreach($feeds as $data)
                  <tr>
                    <td>{{$data->listing_id}}</td>
                    <td>{{base64_decode($data->listing_name)}}</td>
                    <td>{{ $data->address }} </td>
                    <td>{{ $data->title }} </td>
                    <td>{{ $data->ip_address }} </td>

                    <td>{{ $data->same_session_views_count }} </td>
                    <td>{{ date("m/d/Y", strtotime($data->date_created_str)) }}</td>

                  </tr>
                @endforeach
              @endif
              </tbody>
            </table>
            @if(isset($feeds) && count($feeds) > 0)
              {{$feeds->links()}}
              Showing {{$feeds->firstItem()}} to {{$feeds->lastItem()}} of {{$feeds->total()}}
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