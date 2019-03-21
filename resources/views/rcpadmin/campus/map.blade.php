@extends('rcpadmin.layouts.app')
@section('breadcrumbs')
  <div class="breadcrumbs-area clearfix">
    <h4 class="page-title pull-left">Campus Manager</h4>
    <ul class="breadcrumbs pull-left">
      <li><a href="{{ url('rcpadmin/').'/' }}">Home</a></li>
      <li><a href="{{ url('rcpadmin/campus').'/' }}">Campus Manager</a></li>
      <li><span>Edit Campus Guide</span></li>
    </ul>
  </div>
@stop
@section('content')
  <div class="row">
    <!-- Textual inputs start -->
    <div class="col-12 mt-5">
      <div class="card">
        <div class="card-body">
          {!! Form::model($campus,['method'=>'POST', 'files' => true],['action' => ['rcpadmin/CampusController@update_map',$campus['id']] ,'class' => 'col s12']) !!}
          {!! Form::hidden('id') !!}
          {!! Form::hidden('campus_id',$campus['id']) !!}
          @include('rcpadmin.campus.partials.map-form',['buttonText'=>'Update'])
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
@stop

