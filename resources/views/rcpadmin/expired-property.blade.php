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
    <h4 class="page-title pull-left">Expired Properties</h4>
    <ul class="breadcrumbs pull-left">
      <li><a href="{{ url('rcpadmin/').'/' }}">Dashboard</a></li>
      <li><span>Expired Properties</span></li>
    </ul>
  </div>
@stop
@section('content')
  <!-- START CONTENT -->
  <div class="row">

    <div class="col-12 mt-5">
      <div align="center">
        <form action="{{url('rcpadmin/expired-listing-report')}}" method="get">
          Date From <input type="text" name="date_from" value="<?= date("Y-m-d", strtotime("-1 month")) ?>"
                           class="filter-box datePicker">
          To <input type="text" name="date_to" value="<?= date("Y-m-d") ?>" class="filter-box datePicker">

          <select class="filter-box" name="campus_id">
            <option value="All">All Campuses</option>
            @if(!empty($campuses))
              @foreach($campuses as $campus)
                <option value="{{$campus->id}}">{{$campus->title}}</option>
              @endforeach
            @endif
          </select>
          <button type="submit" class="btn btn-success btn-lg"> EXPORT LIST</button>
        </form>
      </div>
      <div class="card">
        <div class="card-body">

          <div class="data-tables datatable-dark">
            <table class="text-center table">
              <thead class="text-capitalize">
              <tr>
                <th>ID</th>

                <th>Title</th>
                <th>Campus</th>
                <th>Lanldord</th>
                <th>Address</th>
                <th>Status</th>
              </tr>
              </thead>
              <tbody>
              @if(count($properties) > 0)
                @foreach($properties as $property)
                  <tr>
                    <td> {{$property['id']}}</td>

                    <td> {{$property['title']}} </td>
                    <td> {{$property['campus']['title']}} </td>
                    <td> {{$property['landlord']['name']}} </td>
                    <td> {{$property['address']}} </td>
                    <td> {{$property['status']}} </td>

                  </tr>
                @endforeach
              @endif
              </tbody>
            </table>
            @if(isset($properties) && count($properties) > 0)
              {{$properties->links()}}
              Showing {{$properties->firstItem()}} to {{$properties->lastItem()}} of {{$properties->total()}}
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

        data: {"id": id, "_method": "DELETE", "_token": "{{ csrf_token() }}"},

        success: function (result) {


          window.location.reload()
          //  console.log(result)

        }
      });

    })

  </script>
@stop