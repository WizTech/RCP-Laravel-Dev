@extends('rcpadmin.layouts.app')
@section('breadcrumbs')
  <div class="breadcrumbs-area clearfix">
    <h4 class="page-title pull-left">Block Email</h4>
    <ul class="breadcrumbs pull-left">
      <li><a href="{{ url('rcpadmin/').'/' }}">Home</a></li>
      <li><a href="{{ url('rcpadmin/block_email').'/' }}">Block Email</a></li>
      <li><span>Add Block Email</span></li>
    </ul>
  </div>
@stop
@section('content')
  <div class="row">
    <div class="col-12 mt-5">
      <div class="card">
        <div class="card-body">
          {!! Form::open(['url' => 'rcpadmin/block_email','class' => 'col s12']) !!}
          {!! Form::hidden('id') !!}
          @include('rcpadmin.block-email.partials.form',['buttonText'=>'Add'])
          {!! Form::close() !!}
        </div>
      </div>
    </div>

  </div>
@stop