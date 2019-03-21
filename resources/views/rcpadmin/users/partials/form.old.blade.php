@if (isset($errors) && count($errors) > 0)
  <div id="card-alert" class="card red lighten-5">
    <div class="card-content red-text">


      @foreach ($errors->all() as $error)
        <p>{{ $error }}</p>
      @endforeach

    </div>
  </div>
@endif

@if(isset($user['role_id']) && $user['role_id'] == '3')
  @php $class = ''; @endphp
  @php $defaultMetaDesc = isset($user['meta_description']) ? $user['meta_description'] : ''; @endphp
  @php $defaultSeoContent = isset($user['seo_block']) ? $user['seo_block'] : ''; @endphp
@else
  @php $class = 'hide'; @endphp
  @php $defaultMetaDesc = ''; @endphp
  @php $defaultSeoContent = ''; @endphp
@endif
<div class="col s12 m12 l6" >
  <div class="card-panel">
    <div class="row">
      <div class="row">

        <div class="input-field col s12">
          {!! Form::select('role_id',[''=>'User Type','4'=>'Student','3'=>'Landlord']) !!}
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12 ">
          {!! Form::select('campus_id[]',$campusSelect,$user_campuses,
              ['class' => 'form-control materialSelect', 'multiple']) !!}
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          {!! Form::label('First Name') !!}
          {!! Form::text('first_name') !!}
        </div>
        <div class="input-field col s6">
          {!! Form::label('Last Name') !!}
          {!! Form::text('last_name') !!}
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          {!! Form::label('Username') !!}
          {!! Form::text('name') !!}
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          {!! Form::label('Email') !!}
          {!! Form::text('email') !!}
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          {!! Form::label('Password') !!}
          {!! Form::password('password') !!}
        </div>
      </div>

      <div class="row">
        <div class="input-field col s12">
          {!! Form::label('Phone Number') !!}
          {!! Form::text('phone_no') !!}
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          {!! Form::label('Address') !!}
          {!! Form::text('address') !!}
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          {!! Form::select('status',[''=>'Status','Active'=>'ACTIVE','Inactive'=>'INACTIVE']) !!}
        </div>
      </div>

    </div>
  </div>
</div>
<div class="col s12 m12 l6 landlord-details {{$class}}">
  <div class="card-panel">
    <div class="row">

      <div class="row">
        <div class="input-field col s6">
          {!! Form::label('H1') !!}
          {!! Form::text('h1') !!}
        </div>
        <div class="input-field col s6">
          {!! Form::label('H2') !!}
          {!! Form::text('h2') !!}
        </div>
      </div>
      <div class="row">

        <div class="input-field col s6">
          {!! Form::label('Twilio Number') !!}
          {!! Form::text('twilio_number') !!}
        </div>

        <div class="input-field col s6">
          {!! Form::label('Company') !!}
          {!! Form::text('company') !!}
        </div>


      </div>
      <div class="row">
        <div class="input-field col s12">
          {!! Form::label('Meta Title') !!}
          {!! Form::text('meta_title') !!}
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          {!! Form::label('Meta Description') !!}
          {!! Form::textarea('meta_description',$defaultMetaDesc,['class="materialize-textarea"']) !!}
        </div>
        <div class="input-field col s6">
          {!! Form::label('Seo Block') !!}
          {!! Form::textarea('seo_block',$defaultSeoContent,['class="materialize-textarea"']) !!}
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          {!! Form::label('Landlord Website') !!}
          {!! Form::text('website') !!}
        </div>
        <div class="input-field col s6">
          {!! Form::label('Fax') !!}
          {!! Form::text('fax') !!}
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          {!! Form::select('type',[''=>'Landlord Type','Personal'=>'Personal','Company'=>'Company']) !!}
        </div>
        <div class="input-field col s6">
          {!! Form::select('activate_twilio',[''=>'Activate Twilio','ACTIVE'=>'ACTIVE','INACTIVE'=>'INACTIVE']) !!}
        </div>
      </div>


      <div class="row">
        <div class="input-field col s6">
          {!! Form::select('landlord_dashboard_status',[''=>'Landlord Dashboard','ACTIVE'=>'ACTIVE','INACTIVE'=>'INACTIVE']) !!}
        </div>
        <div class="input-field col s6">
          {!! Form::select('email_leads',[''=>'Email Leads','ACTIVE'=>'ACTIVE','INACTIVE'=>'INACTIVE']) !!}
        </div>
      </div>

      <div class="row">
        <div class="input-field col s6">
          {!! Form::select('free_trial',[''=>'Free Trial','ACTIVE'=>'ACTIVE','INACTIVE'=>'INACTIVE']) !!}
        </div>
        <div class="input-field col s6">
          {!! Form::select('emma_trial_landlord',[''=>'Email Trial','ACTIVE'=>'ACTIVE','INACTIVE'=>'INACTIVE']) !!}
        </div>
      </div>


    </div>
  </div>
</div>
<div class="row">
  <div class="input-field col s12">

    {!! Form::submit($buttonText,['class'=>'btn cyan waves-effect waves-light right']) !!}
  </div>
</div>