@extends('rcpadmin.layouts.app')
@section('breadcrumbs')
  <div class="breadcrumbs-area clearfix">
    <h4 class="page-title pull-left">Block IP</h4>
    <ul class="breadcrumbs pull-left">
      <li><a href="{{ url('rcpadmin/').'/' }}">Home</a></li>
      <li><a href="{{ url('rcpadmin/block_ip').'/' }}">Block IP</a></li>
      <li><span>Edit Block IP</span></li>
    </ul>
  </div>
@stop
@section('content')
  <div class="row">
    <div class="col-12 mt-5">
      <div class="card">
        <div class="card-body">
          {!! Form::model($ip,['method'=>'PATCH'],['action' => ['rcpadmin/BlockIPController@update',$ip['id']] ,'class' => 'col s12']) !!}
          {!! Form::hidden('id') !!}
          @include('rcpadmin.block-ip.partials.form',['buttonText'=>'Update'])
          {!! Form::close() !!}

        </div>
      </div>
    </div>

  </div>
@stop