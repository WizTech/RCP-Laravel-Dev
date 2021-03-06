@extends('rcpadmin.layouts.app')
@section('breadcrumbs')
  <div class="breadcrumbs-area clearfix">
    <h4 class="page-title pull-left">User Manager</h4>
    <ul class="breadcrumbs pull-left">
      <li><a href="{{ url('rcpadmin/').'/' }}">Home</a></li>
      <li><a href="{{ url('rcpadmin/users').'/' }}">User Manager</a></li>
      <li><span>Add User</span></li>
    </ul>
  </div>
@stop
@section('content')
  <div class="row">
    <!-- Textual inputs start -->
    <div class="col-12 mt-5">
      <div class="card">
        <div class="card-body">

          {!! Form::open(['url' => 'rcpadmin/users','class' => 'col s12']) !!}
          @include('rcpadmin.users.partials.form',['buttonText'=>'Add','user_campuses'=>''])

          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
@stop