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
    <h4 class="page-title pull-left">Imitaion Email</h4>
    <ul class="breadcrumbs pull-left">
      <li><a href="{{ url('rcpadmin/').'/' }}">Dashboard</a></li>
      <li><span>Imitaion Email</span></li>
    </ul>
  </div>
@stop
@section('content')
  <!-- START CONTENT -->
  <div class="row">

    <div class="col-12 mt-5">
      <div align="left">
              <form action="{{url('rcpadmin/imitation-email')}}" method="post">
                {{ csrf_field() }}
                Date From <input type="text" name="date_from" value="<?= date("Y-m-d", strtotime("-1 month")) ?>"
                                 class="filter-box datePicker">
                To <input type="text" name="date_to" value="<?= date("Y-m-d") ?>" class="filter-box datePicker">

                <button type="submit" class="btn btn-success btn-lg"> EXPORT LEADS</button>
              </form>
            </div>
      <div class="card">
        <div class="card-body">

          <div class="table-responsive datatable-dark">
            <table class="text-center table">
              <thead class="text-capitalize">
              <tr>
                <th>ID</th>

                <th>Campus</th>
                <th>Listing</th>
                <th>Username</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Date</th>

              </tr>
              </thead>
              <tbody>
              @if(count($imitationEmail) > 0)
                @foreach($imitationEmail as $data)
                  <tr>
                    <td> {{$data->id}}</td>
                    <td> {{$data->campus_title}}</td>
                    <td> {{$data->property_title}}</td>
                    <td> {{$data->username}}</td>

                    <td> {{$data->first_name.' '.$data->last_name}}</td>
                    <td> {{$data->email}}</td>
                    <td> {{$data->phone_no}}</td>
                    <td> {{$data->date_created}}</td>

                  </tr>
                @endforeach
              @endif
              </tbody>
            </table>
            @if(isset($imitationEmail) && count($imitationEmail) > 0)
              {{$imitationEmail->links()}}
              Showing {{$imitationEmail->firstItem()}} to {{$imitationEmail->lastItem()}}
              of {{$imitationEmail->total()}}
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

  <script>
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

        data: {"id": id, "_method": "destroy", "_token": "{{ csrf_token() }}"},

        success: function (result) {


          window.location.reload()
          //  console.log(result)

        }
      });

    })

  </script>
@stop