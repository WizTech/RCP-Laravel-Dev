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
      {!! Form::hidden('id') !!}
      {!! Form::select('role_id',[''=>'User Type','4'=>'Student','3'=>'Landlord'],null,['class' => 'custom-select roleId']) !!}
    </div>

    <div class="col-md-4 mb-3">
      {!! Form::select('status',[''=>'Status','Active'=>'ACTIVE','Inactive'=>'INACTIVE'],null,['class' => 'custom-select']) !!}
    </div>
    <div class="col-md-4 mb-3">
      {!! Form::select('campus_id[]',$campusSelect,$user_campuses,
                    ['class' => 'custom-select materialSelect', 'multiple']) !!}
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-3 mb-3">
      {!! Form::label('First Name',null,['class' => 'col-form-label']) !!}
      {!! Form::text('first_name',null,['class' => 'form-control']) !!}
    </div>

    <div class="col-md-3 mb-3">
      {!! Form::label('Last Name',null,['class' => 'col-form-label']) !!}
      {!! Form::text('last_name',null,['class' => 'form-control']) !!}
    </div>
    <div class="col-md-3 mb-3">
      {!! Form::label('Username',null,['class' => 'col-form-label']) !!}
      {!! Form::text('name',null,['class' => 'form-control']) !!}
    </div>
    <div class="col-md-3 mb-3">
      {!! Form::label('Email',null,['class' => 'col-form-label']) !!}
      {!! Form::text('email',null,['class' => 'form-control']) !!}
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-3 mb-3">
      {!! Form::label('Password',null,['class' => 'col-form-label']) !!}
      {!! Form::password('password',['class' => 'form-control']) !!}

    </div>
    <div class="col-md-3 mb-3">
      {!! Form::label('Phone Number',null,['class' => 'col-form-label']) !!}
      {!! Form::text('phone_no',null,['class' => 'form-control']) !!}

    </div>
    <div class="col-md-3 mb-3">
      {!! Form::label('Fax',null,['class' => 'col-form-label']) !!}
      {!! Form::text('fax',null,['class' => 'form-control']) !!}

    </div>
    <div class="col-md-3 mb-3">
      {!! Form::label('Address',null,['class' => 'col-form-label']) !!}
      {!! Form::text('address',null,['class' => 'form-control']) !!}

    </div>

  </div>
</div>
<div class="hide landlord-form form-group">
  <div class="form-row">
    <div class="col-md-3 mb-3">
      {!! Form::hidden('id') !!}
      {!! Form::select('type',[''=>'Landlord Type','Personal'=>'Personal','Company'=>'Company'],null,['class' => 'custom-select']) !!}

    </div>

    <div class="col-md-3 mb-3">
      {!! Form::select('free_trial',[''=>'Free Trial','ACTIVE'=>'ACTIVE','INACTIVE'=>'INACTIVE'],null,['class' => 'custom-select']) !!}

    </div>
    {{--<div class="col-md-3 mb-3">
      {!! Form::select('preimum',[''=>'Premium Landlord','ACTIVE'=>'ACTIVE','INACTIVE'=>'INACTIVE'],null,['class' => 'custom-select']) !!}

    </div>--}}
    <div class="col-md-3 mb-3">
      {!! Form::select('email_leads',[''=>'Email Leads','ACTIVE'=>'ACTIVE','INACTIVE'=>'INACTIVE'],null,['class' => 'custom-select']) !!}

    </div>
    <div class="col-md-3 mb-3">
      {!! Form::select('landlord_dashboard_status',[''=>'Landlord Dashboard','ACTIVE'=>'ACTIVE','INACTIVE'=>'INACTIVE'],null,['class' => 'custom-select']) !!}

    </div>

  </div>
  <div class="form-row">

    <div class="col-md-4 mb-3">
      {!! Form::label('Company',null,['class' => 'col-form-label']) !!}
      {!! Form::text('company',null,['class' => 'form-control']) !!}
    </div>

    <div class="col-md-4 mb-3">
      {!! Form::label('Website',null,['class' => 'col-form-label']) !!}
      {!! Form::text('website',null,['class' => 'form-control']) !!}
    </div>

    <div class="col-md-4 mb-3">
      {!! Form::label('Domain',null,['class' => 'col-form-label']) !!}
      {!! Form::text('domain_name',null,['class' => 'form-control']) !!}
    </div>


  </div>
  <div class="form-row">


    <div class="col-md-3 mb-3">
      {!! Form::select('activate_twilio',[''=>'Activate Twilio','ACTIVE'=>'ACTIVE','INACTIVE'=>'INACTIVE'],null,['class' => 'custom-select activate_twilio']) !!}
      {!! Form::text('twilio_number',null,['class' => 'form-control hide twilio_number','placeholder' => 'Twilio Number']) !!}
    </div>
    <div class="col-md-3 mb-3">
      {!! Form::select('is_entrata',[''=>'Entrata Landlord?','ACTIVE'=>'ACTIVE','INACTIVE'=>'INACTIVE'],null,['class' => 'custom-select is_entrata']) !!}
      {!! Form::text('entrata_client_id',null,['class' => 'form-control hide entrata_client_id','placeholder' => 'Client ID']) !!}
    </div>
    <div class="col-md-3 mb-3">
      {!! Form::select('is_yardi',[''=>'Yardi Landlord?','ACTIVE'=>'ACTIVE','INACTIVE'=>'INACTIVE'],null,['class' => 'custom-select is_yardi']) !!}
      {!! Form::text('yardi_user_id',null,['class' => 'form-control hide yardi_user_id','placeholder' => 'Yardi ID']) !!}
    </div>
    <div class="col-md-3 mb-3">
      {!! Form::select('emma_trial_landlord',[''=>'Emma Trial Landlord?','ACTIVE'=>'ACTIVE','INACTIVE'=>'INACTIVE'],null,['class' => 'custom-select emma_trial_landlord']) !!}
    </div>


  </div>


  <div class="form-row">

    <div class="col-md-4 mb-3">
      {!! Form::label('H1',null,['class' => 'col-form-label']) !!}
      {!! Form::text('h1',null,['class' => 'form-control']) !!}
    </div>

    <div class="col-md-4 mb-3">
      {!! Form::label('H2',null,['class' => 'col-form-label']) !!}
      {!! Form::text('h2',null,['class' => 'form-control']) !!}
    </div>

    <div class="col-md-4 mb-3">
      {!! Form::label('Meta Title',null,['class' => 'col-form-label']) !!}
      {!! Form::text('meta_title',null,['class' => 'form-control']) !!}
    </div>

  </div>

  <div class="form-row">
    <div class="col-md-4 mb-3">
      <div class="input-group">
        {!! Form::label('Seo Block',null,['class' => 'input-group-text']) !!}
        {!! Form::textarea('seo_block',null,['class' => 'form-control']) !!}
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <div class="input-group">
        {!! Form::label('About Details',null,['class' => 'input-group-text']) !!}
        {!! Form::textarea('about_details',null,['class' => 'form-control']) !!}
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <div class="input-group">{!! Form::label('Meta Description',null,['class' => 'input-group-text']) !!}
        {!! Form::textarea('meta_description',null,['class' => 'form-control']) !!}</div>

    </div>
  </div>


</div>
<div class="form-group">
  {!! Form::submit($buttonText,['class'=>'btn btn-flat btn-success btn-lg btn-block']) !!}
</div>

@section('scripts')
  <script type="text/javascript">
    $(document).ready(function () {
      $('select.roleId').on('change', function () {
        if ($(this).val() == '3') {
          $('.landlord-form').removeClass('hide');
        } else {
          $('.landlord-form').addClass('hide');
        }

      });
      $('select.activate_twilio').on('change', function () {
        if ($(this).val() == 'ACTIVE') {
          $('.twilio_number').removeClass('hide');
        } else {
          $('.twilio_number').addClass('hide');
        }

      });
      $('select.is_entrata').on('change', function () {
        if ($(this).val() == 'ACTIVE') {
          $('.entrata_client_id').removeClass('hide');
        } else {
          $('.entrata_client_id').addClass('hide');
        }

      });
      $('select.is_yardi').on('change', function () {
        if ($(this).val() == 'ACTIVE') {
          $('.yardi_user_id').removeClass('hide');
        } else {
          $('.yardi_user_id').addClass('hide');
        }

      });
    });
    $(window).load(function () {
      $('select.roleId').trigger('change');
      $('select.activate_twilio').trigger('change');
      $('select.is_entrata').trigger('change');
      $('select.is_yardi').trigger('change');
    })
  </script>
@stop