@extends('rcpadmin.layouts.app')
@section('breadcrumbs')
    <div class="breadcrumbs-area clearfix">
        <h4 class="page-title pull-left"> Career Slider </h4>
        <ul class="breadcrumbs pull-left">
            <li><a href="{{ url('rcpadmin/').'/' }}">Home</a></li>
            <li><a href="{{ url('rcpadmin/careerslider').'/' }}"> Content Manager / Career Slider </a></li>
            <li><span> Edit Career Slider </span></li>
        </ul>
    </div>
@stop
@section('content')
    <div class="row">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    {!! Form::model($careerslider,['method'=>'PATCH', 'files'=>true],['action' => ['rcpadmin/CareerSliderController@update',$careerslider['id']] ,'class' => 'col s12']) !!}
                    {!! Form::hidden('id') !!}
                    @include('rcpadmin.career-slider.partials.form',['buttonText'=>'Update'])
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop