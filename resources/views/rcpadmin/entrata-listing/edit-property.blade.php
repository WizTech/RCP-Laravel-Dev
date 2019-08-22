@extends('rcpadmin.layouts.app')
@section('breadcrumbs')
    <div class="breadcrumbs-area clearfix">
        <h4 class="page-title pull-left"> Listing </h4>
        <ul class="breadcrumbs pull-left">
            <li><a href="{{ url('rcpadmin/').'/' }}">Home</a></li>
            <li><a href="{{ url('rcpadmin/entrata').'/' }}"> Listing </a></li>
            <li><span> Edit Listing </span></li>
        </ul>
    </div>
@stop
@section('content')
    <div class="row">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <form action="{{url('rcpadmin/entrata/update-property',$data['listing']['entrata_listing_id'])}}"
                          method="post" class="col s12">
                        @include('rcpadmin.entrata-listing.partials.property-form',['buttonText'=>'Update'])
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

