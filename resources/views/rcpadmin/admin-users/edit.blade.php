@extends('rcpadmin.layouts.app')
@section('breadcrumbs')
  <div class="breadcrumbs-area clearfix">
    <h4 class="page-title pull-left">Admin Users</h4>
    <ul class="breadcrumbs pull-left">
      <li><a href="{{ url('rcpadmin/').'/' }}">Home</a></li>
      <li><a href="{{ url('rcpadmin/admin_users').'/' }}">Admin Users</a></li>
      <li><span>Edit Admin</span></li>
    </ul>
  </div>
@stop
@section('content')
  <div class="row">
    <!-- Textual inputs start -->
    <div class="col-12 mt-5">
      <div class="card">
        <div class="card-body">


          {!! Form::model($admin_user,['method'=>'PATCH'],['action' => ['rcpadmin/AdminUsers@update',$admin_user['id']] ,'class' => 'col s12']) !!}
          @include('rcpadmin.admin-users.partials.form',['buttonText'=>'Update'])
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
@stop