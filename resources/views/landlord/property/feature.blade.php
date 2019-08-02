@extends('landlord.layouts.app')
@section('breadcrumbs')
  <div class="breadcrumbs-area clearfix">
    <h4 class="page-title pull-left">My Listing</h4>
    <ul class="breadcrumbs pull-left">
      <li><a href="{{ url('landlord/').'/' }}">Home</a></li>
      <li><a href="{{ url('landlord/campus').'/' }}">My Listing</a></li>
      <li><span>Edit My Listing</span></li>
    </ul>
  </div>
@stop
@section('content')
  <div class="row">
    <!-- Textual inputs start -->
    <div class="col-12 mt-5">
      <div class="card">
        <div class="card-body">
          {!! Form::model($features,['method'=>'POST', 'files' => true],['action' => ['landlord/LandlordController@feature_update',$propertyData['id']] ,'class' => 'col s12']) !!}
          {!! Form::hidden('id') !!}
          {!! Form::hidden('property_id',$propertyData['id']) !!}
          @include('landlord.property.partials.feature-form',['buttonText'=>'Update'])
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
@stop

