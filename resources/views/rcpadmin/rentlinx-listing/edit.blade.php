@extends('rcpadmin.layouts.app')
@section('breadcrumbs')
    <div class="breadcrumbs-area clearfix">
        <h4 class="page-title pull-left"> Listing </h4>
        <ul class="breadcrumbs pull-left">
            <li><a href="{{ url('rcpadmin/').'/' }}">Home</a></li>
            <li><a href="{{ url('rcpadmin/rentlinx-listing').'/' }}"> Listing </a></li>
            <li><span> Edit Listing </span></li>
        </ul>
    </div>
@stop
@section('content')
    <div class="row">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">


                    @include('rcpadmin.rentlinx-listing.partials.form',['buttonText'=>'Update'])

                </div>
            </div>
        </div>
    </div>
@stop