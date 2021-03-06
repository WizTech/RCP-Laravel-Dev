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
    <h4 class="page-title pull-left">User Manager</h4>
    <ul class="breadcrumbs pull-left">
      <li><a href="{{ url('rcpadmin/').'/' }}">Dashboard</a></li>
      <li><span>User Manager</span></li>
    </ul>
  </div>
@stop
@section('content')
  <!-- START CONTENT -->
  <div class="row">

    <div class="col-12 mt-5">
      <div class="card">
        <div class="card-body">
          {{--
                    <h4 class="header-title">Data Table Dark</h4>
          --}}
          <a href="{{ url('rcpadmin/users/create')}}" class="btn btn-outline-dark header-title">Add User</a>
          <a href="{{ url('rcpadmin/users/trash')}}" class="btn btn-outline-dark header-title">Trash User</a>
          <form action="{{ url('rcpadmin/user-search')}}" method="POST" role="search">
            {{ csrf_field() }}
            <div class="input-group">
              <input type="text" class="form-control" name="q" id="searchBox"
                     placeholder="Search users"> <span class="input-group-btn">
                             <button type="submit" class="btn btn-default">
                                 Submit
                             </button>
                         </span>
            </div>
          </form>
          <div class="table-responsive datatable-dark">
            <table class="text-center table">
              <thead class="text-capitalize">
              <tr>
                <th>ID</th>
                <th>Role</th>
                <th>Username</th>
                <th>Email</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody id="userData-ajax">
              @if(count($webUsers) > 0)
                @foreach($webUsers as $user)
                  <tr>
                    <td> {{$user['id']}}</td>
                    <td> {{$user['role'] == '3'?'Landlord':'Student'}} </td>
                    <td> {{$user['name']}} </td>
                    <td> {{$user['email']}} </td>
                    <td> {{$user['status']}} </td>
                    <td>
                      <ul class="d-flex justify-content-center">
                        <li class="mr-3"><a target="_blank" href="{{ url('rcpadmin/users/'.$user['id'])}}"
                                            class="text-secondary"><i
                              class="fa fa-edit"></i></a></li>
                        @if($user['role'] == '3')
                        <li class="mr-3"><a target="_blank"
                                            href="{{ url('rcpadmin/property/'.$user['id'].'/landlords')}}"
                                            class="text-secondary" title="View Properties"><i
                              class="fa fa-list"></i></a></li>
                        @endif
                        <li>
                          <form method="POST" action="{{$user['id']}}/delete">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <div class="form-group">
                              <input type="submit" class="btn btn-danger btn-xs delete"
                                     value="Delete">
                            </div>
                          </form>
                          </a>
                        </li>
                      </ul>
                    </td>
                  </tr>
                @endforeach
              @endif
              </tbody>
            </table>
            <div id="pagination-container">
              @if(isset($webUsers) && count($webUsers) > 0)
                {{$webUsers->links() }}
                Showing {{$webUsers->firstItem()}} to {{$webUsers->lastItem()}} of {{$webUsers->total()}}
                Entities
              @endif
            </div>
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
  <script src="{{ env('ASSETS_PATH') }}js/ajax_viewer.js"></script>
  <script>

    $('#searchBox').typeDone(function () {

      var v = $('#searchBox').val();

      if (v == '' || v.length <= 2) {
        return false;
      }

      console.log(v)

      $.ajax({
        url: '<?php echo url('rcpadmin/user-search-ajax')  ?>',
        data: {q: v},
        type: 'POST',
        success: function (res) {
          $('#userData-ajax').html(res)
          $('#pagination-container').html('')
        }
      });

    }, 900);
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