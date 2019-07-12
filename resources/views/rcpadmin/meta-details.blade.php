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
    <h4 class="page-title pull-left">Meta Details</h4>
    <ul class="breadcrumbs pull-left">
      <li><a href="{{ url('rcpadmin/').'/' }}">Dashboard</a></li>
      <li><span>Meta Details</span></li>
    </ul>
  </div>
@stop
@section('content')

  <div class="row">
    <div class="col-12 mt-5">
      <div class="card">
        <div class="card-body">

          <div class="data-tables datatable-dark">
            <table class="text-center table">
              <thead class="text-capitalize">
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Title</th>

                <th>Action</th>
              </tr>
              </thead>
              <tbody>
              @if(count($campuses) > 0)
                @foreach($campuses as $campus)
                  <tr>
                    <td> {{$campus['id']}}</td>
                    <td> {{$campus['name']}} </td>
                    <td> {{$campus['title']}} </td>

                    <td>

                      <ul class="d-flex justify-content-center">
                        <li class="mr-3"><a href="{{ url('rcpadmin/meta-details/'.$campus['id'].'/edit')}}"
                                            class="text-secondary"><i
                              class="fa fa-edit" title="Detail"></i></a></li>


                      </ul>
                    </td>
                  </tr>
                @endforeach
              @endif
              </tbody>
            </table>
            @if(isset($campuses) && count($campuses) > 0)
              {{$campuses->links()}}
              Showing {{$campuses->firstItem()}} to {{$campuses->lastItem()}} of {{$campuses->total()}}
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