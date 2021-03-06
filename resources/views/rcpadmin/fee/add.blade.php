@extends('rcpadmin.layouts.app')
@section('breadcrumbs')
  <div class="breadcrumbs-area clearfix">
    <h4 class="page-title pull-left">Category Manager</h4>
    <ul class="breadcrumbs pull-left">
      <li><a href="{{ url('rcpadmin/').'/' }}">Home</a></li>
      <li><a href="{{ url('rcpadmin/category').'/' }}">Category Manager</a></li>
      <li><span>Add Category</span></li>
    </ul>
  </div>
@stop
@section('content')
  <div class="row">
    <div class="col-12 mt-5">
      <div class="card">
        <div class="card-body">
          {!! Form::open(['url' => 'rcpadmin/category','class' => 'col s12']) !!}
          {!! Form::hidden('id') !!}
          @include('rcpadmin.category.partials.form',['buttonText'=>'Add'])
          {!! Form::close() !!}
        </div>
      </div>
    </div>

  </div>
@stop