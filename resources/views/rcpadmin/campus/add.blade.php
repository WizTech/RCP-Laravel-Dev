@extends('rcpadmin.layouts.app')
@section('breadcrumbs')
  <div class="breadcrumbs-area clearfix">
    <h4 class="page-title pull-left">Campus Manager</h4>
    <ul class="breadcrumbs pull-left">
      <li><a href="{{ url('rcpadmin/').'/' }}">Home</a></li>
      <li><a href="{{ url('rcpadmin/campus').'/' }}">Campus Manager</a></li>
      <li><span>Add Campus</span></li>
    </ul>
  </div>
@stop
@section('styles')
  <link rel="stylesheet" href="{{ env('THEME_ASSETS_NEW') }}assets/chosen-bootstrap/chosen/chosen.css">
@stop
@section('content')
  <div class="row">
    <!-- Textual inputs start -->
    <div class="col-12 mt-5">
      <div class="card">
        <div class="card-body">

          {!! Form::open(['url' => 'rcpadmin/campus','class' => 'col s12']) !!}
          {!! Form::hidden('id') !!}
          @include('rcpadmin.campus.partials.form',['buttonText'=>'Add','linked_campuses'=>''])
          {!! Form::close() !!}

        </div>
      </div>
    </div>
  </div>
@stop

