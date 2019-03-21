@extends('rcpadmin.layouts.master')
@section('styles')
    <link href="{{ env('THEME_ASSETS') }}js/plugins/data-tables/css/jquery.dataTables.min.css" type="text/css"
          rel="stylesheet" media="screen,projection">
@stop
@section('content')
    <!-- START CONTENT -->
    <section id="content">
        <!--breadcrumbs start-->
        <div id="breadcrumbs-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col s12 m12 l12">
                        <h5 class="breadcrumbs-title">Admin User</h5>
                        <ol class="breadcrumbs">
                            <li><a href="{{ url('rcpadmin/') }}">Dashboard</a></li>
                            <li><a href="{{ url('rcpadmin/admin_users') }}">Admin User</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!--breadcrumbs end-->
        <!--start container-->
        <div class="container">
            <div class="section">

                <!--User Add Form-->
                <div id="basic-form" class="section">
                    <div class="row">
                        <div class="col s12 m12 l6">
                            <div class="card-panel">
                                <div class="row">


                                    {!! Form::model($admin_user,['method'=>'POST'],['action' => ['rcpadmin/AdminUsers@modules_update',$admin_user['id']] ,'class' => 'col s12']) !!}
                                    @include('rcpadmin.admin-users.partials.module-form',['buttonText'=>'Update'])

                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!--end container-->

    </section>
    <!-- END CONTENT -->

@stop

@section('scripts')
    <!-- data-tables -->
    <script type="text/javascript"
            src="{{ env('THEME_ASSETS') }}js/plugins/data-tables/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="{{ env('THEME_ASSETS') }}js/plugins/data-tables/data-tables-script.js"></script>
    <script>
        $(document).ready(function () {
            $('[data-table]').dataTable();
        });
    </script>
@stop