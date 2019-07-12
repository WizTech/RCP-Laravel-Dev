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
    <h4 class="page-title pull-left">List Contact Form</h4>
    <ul class="breadcrumbs pull-left">
      <li><a href="{{ url('rcpadmin/').'/' }}">Dashboard</a></li>
      <li><span>List Contact Form</span></li>
    </ul>
  </div>
@stop
@section('content')
  <!-- START CONTENT -->
  <div class="row">

    <div class="col-12 mt-5">
      <div align="center">
             <form action="{{url('rcpadmin/list-contact-export')}}" method="get">
               Date From <input type="text" name="date_from" value="<?= date("Y-m-d", strtotime("-1 month")) ?>"
                                class="filter-box datePicker">
               To <input type="text" name="date_to" value="<?= date("Y-m-d") ?>" class="filter-box datePicker">

               
               <button type="submit" class="btn btn-success btn-lg"> EXPORT LIST</button>
             </form>
           </div>
      <div class="card">
        <div class="card-body">

          <div class="data-tables datatable-dark">
            <table class="text-center table">
              <thead class="text-capitalize">
              <tr>

                <th>Name</th>
                <th>Email</th>
                <th>Company</th>
                <th>Fax</th>
                <th>Date</th>

              </tr>
              </thead>
              <tbody>
              @if(count($data) > 0)
                @foreach($data as $value)
                  <tr>
                    <td> {{$value['name']}}</td>
                    <td> {{$value['email']}}</td>
                    <td> {{$value['company']}}</td>
                    <td> {{$value['fax']}}</td>

                    <td> {{$value['add_date']}} </td>
                  </tr>
                @endforeach
              @endif
              </tbody>
            </table>
            @if(isset($data) && count($data) > 0)
              {{$data->links()}}
              Showing {{$data->firstItem()}} to {{$data->lastItem()}} of {{$data->total()}}
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

@stop