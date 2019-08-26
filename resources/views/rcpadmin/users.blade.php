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
<!-- Modal Begin -->
<div id="modals"></div>
<!-- Modal End -->
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
                <th>Free/Paid</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody id="userData-ajax">
              @if(count($webUsers) > 0)
                @foreach($webUsers as $user)
                  <tr>
                    <td> {{$user->id}}</td>
                    <td> {{$user->role == '3'?'Landlord':'Student'}} </td>
                    <td> {{$user->name}} </td>
                    <td> {{$user->email}} </td>
                    <td> {{$user->free_trial == 'ACTIVE' ? 'Paid' : 'Free Trial'}} </td>
                    <td> {{$user->status}} </td>
                    <td>
                      <input type="hidden" id="user_id" value="{{$user->id}}">
                      <ul class="d-flex justify-content-end">
                        {{--  <li class="mr-3">
                            <button type="button" title="View Profile"
                                    class="btn btn-success btn-xs"><i
                                class="fa fa-user"></i>
                            </button>
                          </li>--}}
                        <li class="mr-3"><a target="_blank"
                                            href="{{ url('rcpadmin/users/'.$user->id.'/login')}}"
                                            class="btn btn-success btn-xs"
                                            title="View Profile"><i
                                    class="fa fa-user"></i></a></li>
                        @if($user->role == '3')

                          <li class="mr-3"><a target="_blank"
                                              href="{{ url('rcpadmin/users/'.$user->id.'/tracker')}}"
                                              class="btn btn-success btn-xs"
                                              title="View Tracker"><i
                                      class="fa fa-signal"></i></a></li>
                          <li class="mr-3"><a target="_blank"
                                              href="{{ url('rcpadmin/property/'.$user->id.'/landlords')}}"
                                              class="btn btn-success btn-xs"
                                              title="View Properties"><i
                                      class="fa fa-list"></i></a></li>
                          <li class="mr-3">
                            <button type="button" title="Update Yardi Listings"
                                    class="btn btn-primary btn-xs"><i
                                      class="fa fa-refresh"></i>
                            </button>
                          </li>
                        @endif

                        {{--<li class="mr-3">
                            <a href="{{ url('rcpadmin/users/'.$user['id'])}}"
                               class="text-secondary">
                                <button class="btn btn-primary btn-xs"><i
                                            class="fa fa-edit"></i> Edit
                                </button>
                            </a>
                        </li>--}}


                        <li class="mr-3">
                          <button type="button" title="Edit User"
                                  data-userid="{{$user->id}}"
                                  class="btn btn-primary btn-xs editUser"><i
                                    class="fa fa-edit"></i>
                          </button>
                        </li>

                        <li>
                          <form method="POST" action="{{$user->id}}/delete">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit" title="Delete User"
                                    class="btn btn-danger btn-xs delete">
                              <i class="fa fa-trash-o"></i>
                            </button>
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
                Showing {{$webUsers->firstItem()}} to {{$webUsers->lastItem()}}
                of {{$webUsers->total()}}
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


  <script>
    $('.editUser').on('click', function () {
      userId = $(this).data('userid');
      $.get('{{ URL::to("rcpadmin/users/edit_user")}}/' + userId, function (data) {
        $('#modals').empty().append(data);
        $('#userModal').modal('show');
      });
    });

    $('#modals').on('submit', '#userEditForm', function (e) {
      e.preventDefault();
      var formData = $(this).serialize();
      $.ajax({
        url: '{{ URL::to("rcpadmin/users/update_user")}}/' + userId,
        type: 'post',
        data: formData,
      }).done(function (data) {
        $('#modals #errors').empty().append(data);
        location.reload();
      }).fail(function (error) {
        var error = error.responseJSON;
        var validationErrors = error.errors;

        console.log(validationErrors);

        if (typeof validationErrors.phone_no !== "undefined") {
          validationErrors.phone_no.forEach(function (element, index) {
            $('#modals #errors').append('<li class="alert alert-danger">' + element + ' <button type = "button" class="close" data-dismiss = "alert">x</button></li>');
          });
        }

        if (typeof validationErrors.status !== "undefined") {
          validationErrors.status.forEach(function (element, index) {
            $('#modals #errors').append('<li class="alert alert-danger">' + element + ' <button type = "button" class="close" data-dismiss = "alert">x</button></li>');
          });
        }

        if (typeof validationErrors.last_name !== "undefined") {
          validationErrors.last_name.forEach(function (element, index) {
            $('#modals #errors').append('<li class="alert alert-danger">' + element + ' <button type = "button" class="close" data-dismiss = "alert">x</button></li>');
          });
        }

        if (typeof validationErrors.first_name !== "undefined") {
          validationErrors.first_name.forEach(function (element, index) {
            $('#modals #errors').append('<li class="alert alert-danger">' + element + ' <button type = "button" class="close" data-dismiss = "alert">x</button></li>');
          });
        }

        if (typeof validationErrors.is_entrata !== "undefined") {
          validationErrors.is_entrata.forEach(function (element, index) {
            $('#modals #errors').append('<li class="alert alert-danger">' + element + ' <button type = "button" class="close" data-dismiss = "alert">x</button></li>');
          });
        }

        if (typeof validationErrors.is_yardi !== "undefined") {
          validationErrors.is_yardi.forEach(function (element, index) {
            $('#modals #errors').append('<li class="alert alert-danger">' + element + ' <button type = "button" class="close" data-dismiss = "alert">x</button></li>');
          });
        }

        if (typeof validationErrors.address !== "undefined") {
          validationErrors.address.forEach(function (element, index) {
            $('#modals #errors').append('<li class="alert alert-danger">' + element + ' <button type = "button" class="close" data-dismiss = "alert">x</button></li>');
          });
        }

        if (typeof validationErrors.name !== "undefined") {
          validationErrors.name.forEach(function (element, index) {
            $('#modals #errors').append('<li class="alert alert-danger">' + element + ' <button type = "button" class="close" data-dismiss = "alert">x</button></li>');
          });
        }

        if (typeof validationErrors.email !== "undefined") {
          validationErrors.email.forEach(function (element, index) {
            $('#modals #errors').append('<li class="alert alert-danger">' + element + ' <button type = "button" class="close" data-dismiss = "alert">x</button></li>');
          });
        }

      });

    });
  </script>
@stop