@extends('rcpadmin.layouts.app')
@section('breadcrumbs')
    <div class="breadcrumbs-area clearfix">
        <h4 class="page-title pull-left">Career Type</h4>
        <ul class="breadcrumbs pull-left">
            <li><a href="{{ url('rcpadmin/').'/' }}">Home</a></li>
            <li><a href="{{ url('rcpadmin/careertype').'/' }}">Content Manager / Career Type</a></li>
            <li><span>Edit Career Type</span></li>
        </ul>
    </div>
@stop
@section('content')
    <div class="row">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    {!! Form::model($careertype,['method'=>'PATCH'],['action' => ['rcpadmin/CareertypeController@update',$careertype['id']] , 'class' => 'col s12']) !!}
                    {{--{!! Form::model($careertype,['method'=>'PATCH'],['action' => ['careertype.update',$careertype['id']] , 'class' => 'col s12']) !!}--}}
                    {!! Form::hidden('id') !!}
                    @include('rcpadmin.careertype.partials.form',['buttonText'=>'Update'])
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop