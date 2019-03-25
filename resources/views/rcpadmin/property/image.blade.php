@extends('rcpadmin.layouts.app')
@section('breadcrumbs')
  <div class="breadcrumbs-area clearfix">
    <h4 class="page-title pull-left">Property Manager</h4>
    <ul class="breadcrumbs pull-left">
      <li><a href="{{ url('rcpadmin/').'/' }}">Home</a></li>
      <li><a href="{{ url('rcpadmin/campus').'/' }}">Property Manager</a></li>
      <li><span>Edit Property Floorplans</span></li>
    </ul>
  </div>
@stop
@section('content')
  <div class="row">
    <!-- Textual inputs start -->
    <div class="col-12 mt-5">
      <div class="card">
        <div class="card-body">
          {!! Form::model($images,['method'=>'POST', 'files' => true],['action' => ['rcpadmin/PropertyController@update_images',$propertyData['id']] ,'class' => 'col s12']) !!}
          {!! Form::hidden('id') !!}
          {!! Form::hidden('property_id',$propertyData['id']) !!}
          @include('rcpadmin.property.partials.image-form',['buttonText'=>'Update'])
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
@stop

