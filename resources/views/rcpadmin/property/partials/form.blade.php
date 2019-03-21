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


    <div class="col-md-3 mb-2">

      {!! Form::select('campus_id',$campusSelect,null,['class' => 'custom-select']) !!}
    </div>
    <div class="col-md-3 mb-2">

      {!! Form::select('category_id',$categorySelect,null,['class' => 'custom-select']) !!}
    </div>
    <div class="col-md-3 mb-2">
      {!! Form::select('landlord_id',$usersSelect,null,['class' => 'custom-select']) !!}
    </div>
    <div class="col-md-3 mb-2">
      {!! Form::select('status',[''=>'Status','Active'=>'ACTIVE','Inactive'=>'INACTIVE'],null,['class' => 'custom-select']) !!}

    </div>
    <div class="col-md-3 mb-2">
      {!! Form::label('Listing Title',null,['class' => 'col-form-label']) !!}
      {!! Form::text('title',null,['class' => 'form-control']) !!}
    </div>
    <div class="input-field col-md-3 mb-2 col s12">
      {!! Form::label('Address',null,['class' => 'col-form-label']) !!}
      {!! Form::text('address',null,['class' => 'form-control']) !!}
    </div>
    <div class="col-md-3 mb-2">
      {!! Form::label('Email',null,['class' => 'col-form-label']) !!}
      {!! Form::text('email',null,['class' => 'form-control','placeholder'=>'put comma ( , ) to add multiple emails']) !!}
    </div>

    <div class="col-md-3 mb-2">
      {!! Form::label('Phone',null,['class' => 'col-form-label']) !!}
      {!! Form::text('phone',null,['class' => 'form-control']) !!}
    </div>


    <div class="col-md-4 mb-3">
      {!! Form::label('Type of listing',null,['class' => 'col-form-label']) !!}
      {!! Form::select('free_trial',['ACTIVE'=>'ACTIVE','INACTIVE'=>'INACTIVE'],null,['class' => 'custom-select']) !!}

    </div>
    <div class="col-md-4 mb-3">
      {!! Form::label('Rent Style',null,['class' => 'col-form-label']) !!}
      {!! Form::select('pricing',['ACTIVE'=>'ACTIVE','INACTIVE'=>'INACTIVE'],null,['class' => 'custom-select']) !!}

    </div>

    <div class="col-md-4 mb-3">
      {!! Form::select('double_featured',[''=>'Double Featured','ACTIVE'=>'ACTIVE','INACTIVE'=>'INACTIVE'],null,['class' => 'custom-select double_featured']) !!}
      {!! Form::text('double_featured_order',null,['class' => 'form-control hide double_featured_order','placeholder' => 'Rank']) !!}

    </div>
    <div class="col-md-4 mb-3">
      {!! Form::label('Twilio Number',null,['class' => 'col-form-label']) !!}
      {!! Form::text('twilio_number',null,['class' => 'form-control']) !!}
    </div>
<div class="col-md-4 mb-3">
      {!! Form::label('Units Number',null,['class' => 'col-form-label']) !!}
      {!! Form::text('units_number',null,['class' => 'form-control']) !!}
    </div>


    <div class="col-md-4 mb-4">
      {!! Form::label('Meta Title',null,['class' => 'col-form-label']) !!}
      {!! Form::text('meta_title',null,['class' => 'form-control']) !!}
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-6 mb-4">
      {!! Form::label('Description',null,['class' => 'input-group-text']) !!}
      {!! Form::textarea('description',null,['class' => 'form-control']) !!}

    </div>
    <div class="col-md-6 mb-4">
      {!! Form::label('Seo Block',null,['class' => 'input-group-text']) !!}
      {!! Form::textarea('copy',null,['class' => 'form-control']) !!}

    </div>
    <div class="col-md-6 mb-4">
      {!! Form::label('Meta Description',null,['class' => 'input-group-text']) !!}
      {!! Form::textarea('meta_description',null,['class' => 'form-control']) !!}

    </div>
    <div class="col-md-6 mb-4">
      {!! Form::label('Special',null,['class' => 'input-group-text']) !!}
      {!! Form::textarea('special',null,['class' => 'form-control']) !!}

    </div>


  </div>
  <div class="form-row">


    <div class="col-md-3 mb-2">
      {!! Form::label('Property Expiry',null,['class' => 'col-form-label']) !!}
      {!! Form::text('property_expiry_date',null,['class' => 'form-control']) !!}
    </div>

    <div class="col-md-3 mb-2">
      {!! Form::label('Special Expiry',null,['class' => 'col-form-label']) !!}
      {!! Form::text('special_expiry',null,['class' => 'form-control']) !!}
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

    $(document).ready(function () {
      $('select.double_featured').on('change', function () {
        if ($(this).val() == 'ACTIVE') {
          $('.double_featured_order').removeClass('hide');
        } else {
          $('.double_featured_order').addClass('hide');
        }

      });

    });

  </script>
@stop


