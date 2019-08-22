@extends('rcpadmin.layouts.app')
@section('breadcrumbs')
  <div class="breadcrumbs-area clearfix">
    <h4 class="page-title pull-left">User Manager</h4>
    <ul class="breadcrumbs pull-left">
      <li><a href="{{ url('rcpadmin/').'/' }}">Home</a></li>
      <li><a href="{{ url('rcpadmin/users').'/' }}">User Manager</a></li>
      <li><span>Edit User</span></li>
    </ul>
  </div>
@stop
@section('content')
  <div class="row">
    <!-- Textual inputs start -->
    <div class="col-12 mt-5">
      <div class="card">
        <div class="card-body">

          {!! Form::model($user,['method'=>'PATCH'],['action' => ['rcpadmin/UsersController@update',$user['id']] ,'class' => 'col s12']) !!}
          {!! Form::hidden('id') !!}
          @include('rcpadmin.users.partials.form',['buttonText'=>'Update','user_campuses'=>$user_campuses])
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
@stop
