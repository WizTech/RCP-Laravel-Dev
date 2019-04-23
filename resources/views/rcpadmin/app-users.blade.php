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
        <h4 class="page-title pull-left">App Users</h4>
        <ul class="breadcrumbs pull-left">
            <li><a href="{{ url('rcpadmin/').'/' }}">Dashboard</a></li>
            <li><span>Application Stats /</span></li>
            <li><a href="{{'app-users'}}">App Users</a></li>
        </ul>
    </div>
@stop
@section('content')
    <div class="row">
        <div class="col-12 mt-5">
            <div class="card">
                <div align="right">
                    <form action="{{url('rcpadmin/app-users')}}" method="get">
                        <select class="select-box device_type" name="device_type" id="deviceType">
                            <?php if (isset($_GET['device_type']) && $_GET['device_type'] == 'All'): ?>
                            <option value="<?= $_GET['device_type'] ?>" selected><?= $_GET['device_type'] ?></option>
                            <?php else: ?>
                            <option value="All">All</option>
                            <?php endif; ?>

                            <?php if (isset($_GET['device_type']) && $_GET['device_type'] == 'IOS'): ?>
                            <option value="<?= $_GET['device_type'] ?>" selected><?= $_GET['device_type'] ?></option>
                            <?php else: ?>
                            <option value="IOS">IOS</option>
                            <?php endif; ?>

                            <?php if (isset($_GET['device_type']) && $_GET['device_type'] == 'Android'): ?>
                            <option value="<?= $_GET['device_type'] ?>" selected><?= $_GET['device_type'] ?></option>
                            <?php else: ?>
                            <option value="Android">Android</option>
                            <?php endif; ?>
                        </select>
                        {{ csrf_field() }}
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive datatable-dark">
                        <table class="text-center table">
                            <thead class="text-capitalize">
                            <tr>
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Device Type</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($appUsers))
                                @foreach($appUsers as $appUser)
                                    <tr>
                                        <td><?= $appUser->username  ?></td>
                                        <td><?= $appUser->email  ?></td>
                                        <td><?= $appUser->phone  ?></td>
                                        <td><?= $appUser->device_type  ?></td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                        @if(isset($appUsers) && count($appUsers) > 0)
                            {{ $appUsers->links() }}
                            Showing {{$appUsers->firstItem()}} to {{$appUsers->lastItem()}} of {{$appUsers->total()}}
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

                data: {"id": id, "_token": "{{ csrf_token() }}"},

                success: function (result) {

                    window.location.reload()
                    //  console.log(result)

                }
            });

        })

    </script>
    <script>
        $(document).ready(function () {
            $('#deviceType').on('change', function () {
                this.form.submit();
            });
        });
    </script>
@stop