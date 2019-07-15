@extends('rcpadmin.layouts.app')
@section('breadcrumbs')
  <div class="breadcrumbs-area clearfix">
    <h4 class="page-title pull-left">Meta Details</h4>
    <ul class="breadcrumbs pull-left">
      <li><a href="{{ url('rcpadmin/').'/' }}">Home</a></li>
      <li><a href="{{ url('rcpadmin/meta-details').'/' }}">Meta Details</a></li>
      <li><span>Edit Meta Details</span></li>
    </ul>
  </div>
@stop
@section('content')
  <div class="row">
    <!-- Textual inputs start -->
    <div class="col-12 mt-5">
      <div class="card">
        <div class="card-body">
          <form action="{{ route('meta-details.update', $campusId) }}" method="POST" class="col s12">

            {!! Form::hidden('id') !!}
            {{ csrf_field() }}
            {{ method_field('PUT')}}
            {!! Form::hidden('campus_id',$campusId) !!}
            @include('rcpadmin.meta-details.partials.map-form',['buttonText'=>'Update'])
            {{-- {!! Form::close() !!}--}}
          </form>
        </div>
      </div>
    </div>
  </div>
@stop

