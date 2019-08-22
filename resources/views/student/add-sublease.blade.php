@extends('student.layouts.app')

@section('breadcrumbs')
  <div class="breadcrumbs-area clearfix">
    <h4 class="page-title pull-left">Student Portal</h4>
    <ul class="breadcrumbs pull-left">
      <li><a href="{{ url('student/').'/' }}">Home</a></li>
      <li><span>Add Sublease</span></li>
    </ul>
  </div>
@stop
@section('content')
  <!-- START CONTENT -->
  <div class="row">
    <!-- Textual inputs start -->
    <div class="col-12 mt-5">
      <div class="card">
        <div class="card-body">


          {!! Form::model($user,['method'=>'POST'],['action' => ['StudentController@updateSublease',$user['id']] ,'class' => 'col s12']) !!}
          @include('student.partials.sublease-form',['buttonText'=>'Add Sublease'])
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
  <!-- END CONTENT -->
@stop
