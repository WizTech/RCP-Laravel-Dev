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
    {!! Form::label('Current Password',null,['class' => 'col-form-label']) !!}
    {!! Form::text('current_password',null,['class' => 'form-control']) !!}
  </div>
  <div class="col-md-12 mb-12">
    {!! Form::label('New Password',null,['class' => 'col-form-label']) !!}
    {!! Form::password('password',['class' => 'form-control']) !!}
  </div>
  <div class="col-md-12 mb-12">
    {!! Form::label('Confirm Password',null,['class' => 'col-form-label']) !!}
    {!! Form::password('password_confirmation',['class' => 'form-control']) !!}
  </div>


</div>
<div class="form-group">
  {!! Form::submit($buttonText,['class'=>'btn btn-flat btn-success btn-lg btn-block']) !!}

</div>


