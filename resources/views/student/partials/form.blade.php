@if (isset($errors) && count($errors) > 0)


  <div id="card-alert" class="card red lighten-5">
    <div class="card-content red-text">


      @foreach ($errors->all() as $error)
        <p>{{ $error }}</p>
      @endforeach

    </div>
  </div>
@endif
{!! Form::hidden('id') !!}
<div class="form-row">
  <div class="col-md-12 mb-12">
      {!! Form::label('Email',null,['class' => 'col-form-label']) !!}
      {!! Form::text('email',null,['class' => 'form-control','readonly'=>true]) !!}
    </div>
  <div class="col-md-12 mb-12">
    {!! Form::label('First Name',null,['class' => 'col-form-label']) !!}
    {!! Form::text('first_name',null,['class' => 'form-control']) !!}
  </div>

  <div class="col-md-12 mb-12">
    {!! Form::label('Last Name',null,['class' => 'col-form-label']) !!}
    {!! Form::text('last_name',null,['class' => 'form-control']) !!}
  </div>
  <div class="col-md-12 mb-12">
    {!! Form::label('Username',null,['class' => 'col-form-label']) !!}
    {!! Form::text('name',null,['class' => 'form-control']) !!}
  </div>

</div>
<div class="form-row">
  <div class="col-md-12 mb-12">
    {!! Form::label('Phone Number',null,['class' => 'col-form-label']) !!}
    {!! Form::text('phone_no',null,['class' => 'form-control']) !!}

  </div>
  <div class="col-md-12 mb-12">
    {!! Form::label('Fax',null,['class' => 'col-form-label']) !!}
    {!! Form::text('fax',null,['class' => 'form-control']) !!}

  </div>
  <div class="col-md-12 mb-12">
    {!! Form::label('Address',null,['class' => 'col-form-label']) !!}
    {!! Form::text('address',null,['class' => 'form-control']) !!}

  </div>

</div>
<div class="form-group">
  {!! Form::submit($buttonText,['class'=>'btn btn-flat btn-success btn-lg btn-block']) !!}

</div>


