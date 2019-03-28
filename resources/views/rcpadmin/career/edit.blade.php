@extends('rcpadmin.layouts.app')
@section('breadcrumbs')
    <div class="breadcrumbs-area clearfix">
        <h4 class="page-title pull-left">Careers</h4>
        <ul class="breadcrumbs pull-left">
            <li><a href="{{ url('rcpadmin/').'/' }}">Home</a></li>
            <li><a href="{{ url('rcpadmin/career').'/' }}">Content Manager / Careers</a></li>
            <li><span>Edit Career</span></li>
        </ul>
    </div>
@stop
@section('content')
    <div class="row">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    {!! Form::model($careers['career'],['method'=>'PATCH'],['action' => ['rcpadmin/CareerController@update',$careers['career']['id']] , 'class' => 'col s12']) !!}
                    {!! Form::hidden('id') !!}
                    @include('rcpadmin.career.partials.form',['buttonText'=>'Update'])
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop