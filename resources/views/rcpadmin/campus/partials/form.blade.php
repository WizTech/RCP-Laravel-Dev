@if (isset($errors) && count($errors) > 0)
  <div id="card-alert" class="card red lighten-5">
    <div class="card-content red-text">


      @foreach ($errors->all() as $error)
        <p>{{ $error }}</p>
      @endforeach

    </div>
  </div>
@endif
<div class="form-group">
  <div class="form-row">


    <div class="col-md-4 mb-3">
      {!! Form::label('Campus Name',null,['class' => 'col-form-label']) !!}
      {!! Form::text('name',null,['class' => 'form-control','data-role'=>"tagsinput"]) !!}
    </div>

    <div class="col-md-4 mb-3">
      {!! Form::label('Campus Title',null,['class' => 'col-form-label']) !!}
      {!! Form::text('title',null,['class' => 'form-control']) !!}
    </div>
    <div class="input-field col s12">
      {!! Form::label('Address',null,['class' => 'col-form-label']) !!}
      {!! Form::text('address',null,['class' => 'form-control']) !!}
    </div>
    <div class="col-md-4 mb-3">
      {!! Form::label('H1',null,['class' => 'col-form-label']) !!}
      {!! Form::text('h1',null,['class' => 'form-control']) !!}
    </div>

    <div class="col-md-4 mb-3">
      {!! Form::label('H2',null,['class' => 'col-form-label']) !!}
      {!! Form::text('h2',null,['class' => 'form-control']) !!}
    </div>


    <div class="input-field col s12">
      {!! Form::label('Meta Title',null,['class' => 'col-form-label']) !!}
      {!! Form::text('meta_title',null,['class' => 'form-control']) !!}
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-6 mb-6">
      {!! Form::label('Meta Description',null,['class' => 'input-group-text']) !!}
      {!! Form::textarea('meta_description',null,['class' => 'form-control']) !!}

    </div>
    <div class="col-md-6 mb-6">
      {!! Form::label('Seo Block',null,['class' => 'input-group-text']) !!}
      {!! Form::textarea('seo_block',null,['class' => 'form-control']) !!}

    </div>

  </div>
  <div class="form-row">
    {{--<div class="col-md-4 mb-4">
      {!! Form::select('campus_linked[]',['1'=>'madison','2'=>'marquette'],null,['class' => 'custom-select chosen','multiple','data-placeholder'=>"Campus Linked" ]) !!}
    </div>--}}
    <div class="col-md-4 mb-4">
        {!! Form::select('campus_linked[]',$campusSelect,$linked_campuses,
            ['class' => 'form-control',
            'multiple' => 'multiple']) !!}

    </div>
    <div class="col-md-4 mb-4">
      {!! Form::select('featured_landlord',$usersSelect,null,['class' => 'custom-select']) !!}
    </div>
    <div class="col-md-4 mb-4">
      {!! Form::select('live',[''=>'Make Live?','Active'=>'ACTIVE','Inactive'=>'INACTIVE'],null,['class' => 'custom-select']) !!}
    </div>
    <div class="col-md-4 mb-4">
      {!! Form::select('rating',[''=>'Rating?','Active'=>'ACTIVE','Inactive'=>'INACTIVE'],null,['class' => 'custom-select']) !!}
    </div>
    <div class="col-md-4 mb-4">
      {!! Form::select('premium_banner',[''=>'Show Premium Banner?','Active'=>'ACTIVE','Inactive'=>'INACTIVE'],null,['class' => 'custom-select']) !!}
    </div>
    <div class="col-md-4 mb-4">
      {!! Form::select('status',[''=>'Status','Active'=>'ACTIVE','Inactive'=>'INACTIVE'],null,['class' => 'custom-select']) !!}

    </div>
  </div>


</div>
<div class="form-group">
  <div class="col-md-12 mb-12">
    {!! Form::submit($buttonText,['class'=>'btn btn-flat btn-success btn-lg btn-block']) !!}
  </div>
</div>

@section('scripts')
  <!-- data-tables -->

  <!-- Start datatable js -->
  <script src="{{ env('THEME_ASSETS_NEW') }}assets/chosen-bootstrap/chosen/chosen.jquery.min.js"></script>



  <script>
    jQuery.browser = {};
    (function () {
      jQuery.browser.msie = false;
      jQuery.browser.version = 0;
      if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
        jQuery.browser.msie = true;
        jQuery.browser.version = RegExp.$1;
      }
    })();
    $('.chosen').chosen({width: "100%"});

  </script>
@stop