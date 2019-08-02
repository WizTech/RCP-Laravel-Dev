@extends('landlord.layouts.app')
@section('breadcrumbs')
  <div class="breadcrumbs-area clearfix">
    <h4 class="page-title pull-left">Property Manager</h4>
    <ul class="breadcrumbs pull-left">
      <li><a href="{{ url('landlord/').'/' }}">Home</a></li>
      <li><a href="{{ url('landlord/campus').'/' }}">Property Manager</a></li>
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
          {!! Form::model($floorplans,['method'=>'POST', 'files' => true],['action' => ['landlord/LandlordController@update_floorplan',$propertyData['id']] ,'class' => 'col s12']) !!}
          {!! Form::hidden('id') !!}
          {!! Form::hidden('property_id',$propertyData['id']) !!}
          @include('landlord.property.partials.floorplan-form',['buttonText'=>'Update'])
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
@stop

