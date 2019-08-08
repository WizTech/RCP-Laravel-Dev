<?php
session_start();
?>
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
        <h4 class="page-title pull-left">Admin Users</h4>
        <ul class="breadcrumbs pull-left">
            <li><a href="{{ url('rcpadmin/').'/' }}">Home</a></li>
            <li><span>Admin Users</span></li>
        </ul>
    </div>
@stop

<!-- Modal Begin -->
<div style="display: none" class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-green modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Export User Activities</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{url('rcpadmin/export-activities')}}" method="get">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6> Date From </h6>
                            <input type="text" name="date_from" value="<?= date("Y-m-d", strtotime("-1 month")) ?>"
                                   class="datePicker">
                        </div>
                        <div class="col-md-6">
                            <h6> Date To </h6>
                            <input type="text" name="date_to" value="<?= date("Y-m-d", strtotime("1 day")) ?>"
                                   class="datePicker">
                        </div>
                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-xs"> EXPORT LIST</button>
                    <button type="button" class="btn btn-secondary btn-xs" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal End -->
@section('content')
    <div class="row">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <a href="{{ url('rcpadmin/admin_users/create')}}" class="btn btn-outline-dark header-title">Add
                        Admin</a>
                    <div class="table-responsive datatable-dark">
                        <table class="text-center table">
                            <thead class="text-capitalize">
                            <tr>
                                <th>ID</th>
                                <th>Role</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($webUsers) > 0)
                                @foreach($webUsers as $user)
                                    <tr>
                                        <td> {{$user['id']}}</td>
                                        <td> {{$user['role']['name']}} </td>
                                        <td> {{$user['name']}} </td>
                                        <td> {{$user['email']}} </td>
                                        <td> {{$user['status']}} </td>
                                        <td>
                                            <ul class="d-flex justify-content-center">

                                                <li class="mr-3">
                                                    <a href="#"
                                                       class="btn btn-success btn-xs fa fa-download" title="Export Activities" data-toggle="modal" data-target="#exampleModal" ></a>
                                                </li>


                                                <li class="mr-3">
                                                    <a href="{{ url('rcpadmin/admin_users/'.$user['id'])}}"
                                                       class="btn btn-primary btn-xs fa fa-edit" title="Edit" target="_blank"></a>
                                                </li>

                                                <li class="mr-3">
                                                    <a href="{{ url('rcpadmin/admin_users/'.$user['id'].'/modules')}}"
                                                            class="btn btn-primary btn-xs fa fa-lock" title="Permissions" target="_blank"></a>
                                                </li>
                                                <li>
                                                    <form method="POST" action="admin_users/{{$user['id']}}">
                                                        {{ csrf_field() }}
                                                        {{ method_field('DELETE') }}
                                                        <div class="form-group">
                                                            <button type="submit" class="btn btn-danger btn-xs delete" title="Delete"><i class="fa fa-trash-o"></i></button>
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
                        @if(isset($webUsers) && count($webUsers) > 0)
                            {{$webUsers->links()}}
                            Showing {{$webUsers->firstItem()}} to {{$webUsers->lastItem()}} of {{$webUsers->total()}}
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

    <!-- Start datatable js -->
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

                data: {"id": id, "_token": "{{ csrf_token() }}"},

                success: function (result) {


                    window.location.reload()
                    //  console.log(result)

                }
            });

        })

    </script>

    <script>
        $('#exampleModal').modal('hide');
        $(document).ready(function () {
            $('#exampleModal').on('shown.bs.modal', function () {
                $('#myInput').trigger('focus')
            });
        });
    </script>

@stop

