@extends('rcpadmin.layouts.app')
@section('breadcrumbs')
  <div class="breadcrumbs-area clearfix">
    <h4 class="page-title pull-left">Premium Landlord</h4>
    <ul class="breadcrumbs pull-left">
      <li><a href="{{ url('rcpadmin/').'/' }}">Home</a></li>
      <li><a href="{{ url('rcpadmin/premium-listings').'/' }}">Premium Listings</a></li>
      <li><span>Edit Premium Listing</span></li>
    </ul>
  </div>
@stop
@section('content')
  <div class="row">
    <!-- Textual inputs start -->
    <div class="col-12 mt-5">
      <div class="card">
        <div class="card-body">
          {!! Form::model($property,['method'=>'PATCH', 'files' => true],['action' => ['rcpadmin/PreimumListingsController@update',$property['id']] ,'class' => 'col s12']) !!}
          {!! Form::hidden('id') !!}
          {!! Form::hidden('user_id',$property['id']) !!}
          @include('rcpadmin.premium-listings.partials.form',['buttonText'=>'Update'])
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
@stop

