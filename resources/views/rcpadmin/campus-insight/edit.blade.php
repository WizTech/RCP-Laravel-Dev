@extends('rcpadmin.layouts.app')
@section('breadcrumbs')
    <div class="breadcrumbs-area clearfix">
        <h4 class="page-title pull-left">Campus Insight</h4>
        <ul class="breadcrumbs pull-left">
            <li><a href="{{ url('rcpadmin/').'/' }}">Home</a></li>
            <li><a href="{{ url('rcpadmin/campus-insight').'/' }}">Content Manager / Campus Insight </a></li>
            <li><span>Edit Campus Insight</span></li>
        </ul>
    </div>
@stop
@section('content')
    <div class="row">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    {!! Form::model($campusInight['campus_insight'],['method'=>'PATCH', 'files'=>true],['action' => ['rcpadmin/CampusInsightController@update',$campusInight['campus_insight']['id']] , 'class' => 'col s12']) !!}
                    {!! Form::hidden('id') !!}
                    @include('rcpadmin.campus-insight.partials.form',['buttonText'=>'Update'])
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop