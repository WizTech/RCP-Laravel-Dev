@extends('rcpadmin.layouts.app')
@section('breadcrumbs')
  <div class="breadcrumbs-area clearfix">
    <h4 class="page-title pull-left">Template Manager</h4>
    <ul class="breadcrumbs pull-left">
      <li><a href="{{ url('rcpadmin/').'/' }}">Home</a></li>
      <li><a href="{{ url('rcpadmin/template').'/' }}">Template Manager</a></li>
      <li><span>Add Template</span></li>
    </ul>
  </div>
@stop
@section('content')
  <div class="row">
    <div class="col-12 mt-5">
      <div class="card">
        <div class="card-body">
          {!! Form::model($template,['method'=>'PATCH'],['action' => ['rcpadmin/TemplateController@update',$template['id']] ,'class' => 'col s12']) !!}
          {!! Form::hidden('id') !!}
          @include('rcpadmin.template.partials.form',['buttonText'=>'Update'])
          {!! Form::close() !!}

        </div>
      </div>
    </div>

  </div>
@stop