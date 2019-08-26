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
    <h4 class="page-title pull-left">Team Members</h4>
    <ul class="breadcrumbs pull-left">
      <li><a href="{{ url('rcpadmin/').'/' }}">Dashboard</a></li>
      <li><span>Team Members</span></li>
    </ul>
  </div>
@stop
@section('content')
  <!-- START CONTENT -->
  <div class="row">

    <div class="col-12 mt-5">
      <div class="card">
        <div class="card-body">
          <a href="{{ url('rcpadmin/team-member/create')}}" class="btn btn-outline-dark header-title">Add Team Member</a>
          <div class="data-tables datatable-dark">
            <table id="dataTable3" class="text-center">
              <thead class="text-capitalize">
              <tr>
                <th>ID</th>

                <th>Name</th>
                <th>Position</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
              @if(count($users) > 0)
                @foreach($users as $user)
                  <tr>
                    <td> {{$user['id']}}</td>

                    <td> {{$user['name']}} </td>
                    <td> {{$user['position']}} </td>
                    <td> {{$user['status']}} </td>
                    <td>
                      <ul class="d-flex justify-content-center">

                        <li class="mr-3">
                          <a href="{{ url('rcpadmin/team-member/'.$user['id'])}}" title="Edit Team">
                            <button class="btn btn-primary btn-xs">
                              <i class="fa fa-edit"></i> Edit
                            </button>
                          </a>
                        </li>

                        <li><a data-admin-id="{{$user['id']}}" href="{{url('rcpadmin/team-member/'.$user['id'])}}"
                               data-method="delete" class="btn btn-danger btn-xs jquery-postback" title="Delete">

                              <i class="ti-trash-o"></i> Delete

                            </a>
                        </li>
                      </ul>
                    </td>
                  </tr>
                @endforeach
              @endif
              </tbody>
            </table>
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

        data: {"id": id,"_method":"destroy","_token": "{{ csrf_token() }}"},

        success: function (result) {


          window.location.reload()
          //  console.log(result)

        }
      });

    })

  </script>
@stop