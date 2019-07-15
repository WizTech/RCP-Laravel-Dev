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
  <link rel="stylesheet" type="text/css"
        href="{{ env('THEME_ASSETS_NEW') }}assets/css/bootstrap-toggle.min.css">
  <!-- style css -->
@stop
@section('breadcrumbs')
  <div class="breadcrumbs-area clearfix">
    <h4 class="page-title pull-left">Stats</h4>
    <ul class="breadcrumbs pull-left">
      <li><a href="{{ url('rcpadmin/').'/' }}">Dashboard</a></li>
      <li><span>Stats / </span></li>
      <li><a href="{{'rcpadmin/top-spots'}}">Topspots </a></li>
    </ul>
  </div>
@stop
@section('content')
  <div class="row">
    <div class="col-12 mt-5">


      <div class="card">
        <div class="card-body">
          <div class="table-responsive datatable-dark">
            <table class="text-center table">
              <thead class="text-capitalize">
              <tr>

                <th>No</th>
                <th>Property</th>
                <th>Username</th>
                <th>Double Featured Order</th>
                <th>Double Featured Expiry</th>
                <th>Paid /Free Trial</th>
                <th>Action</th>

              </tr>
              </thead>
              <tbody>
              @if(!empty($data))
                @foreach( $data as $listings)
                  <tr>
                    <td>{{$listings->id}} </td>
                    <td>{{empty($listings->title == false)?$listings->title:$listings->address}} </td>
                    <td>{{$listings->name}} </td>
                    <td>{{$listings->double_featured_ord}} </td>
                    <td>{{$listings->double_feature_expiry_date}} </td>
                    <td data-topspot="{{$listings->topspot_paid}}">
                          @if ($listings->topspot_paid  == 'Active')
                          <input type="checkbox" name="on" data-listing-id="{{$listings->id}}" id="toggle-two" data-toggle="toggle" data-on="Enabled" data-off="Disabled">
                          @else
                          <input type="checkbox" name="off" data-listing-id="{{$listings->id}}" id="toggle-one" data-toggle="toggle" data-on="Enabled" data-off="Disabled">
                          @endif
                    </td>
                    <td>
                      <ul class="d-flex justify-content-center">
                        <li class="mr-3"><a href="{{ url('rcpadmin/top-spots/'.$listings->id)}}"
                                            class="text-secondary"><i
                              class="fa fa-remove"></i></a></li>
                      </ul>
                    </td>


                  </tr>
                @endforeach
              @endif
              </tbody>
            </table>
            @if(isset($data) && count($data) > 0)
              {{$data->links()}}
              Showing {{$data->firstItem()}} to {{$data->lastItem()}}
              of {{$data->total()}}
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
  <script src="{{ env('THEME_ASSETS_NEW') }}assets/cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
  <script src="{{ env('THEME_ASSETS_NEW') }}assets/cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
  <script src="{{ env('THEME_ASSETS_NEW') }}assets/cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>

  <script
    src="{{ env('THEME_ASSETS_NEW') }}assets/cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
  <script
    src="{{ env('THEME_ASSETS_NEW') }}assets/cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
  <script src="{{ env('THEME_ASSETS_NEW') }}assets/js/bootstrap-toggle.min.js"></script>
  <script>
    $(document).ready(function(){


        $('#toggle-one').bootstrapToggle({
            on: 'Paid',
            off: 'Free Trial'
        });

        $('#toggle-two').bootstrapToggle({
            on: 'Free Trial',
            off: 'Paid'
        });
    })
  </script>
@stop