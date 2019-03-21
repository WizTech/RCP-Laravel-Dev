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
  {!! Form::label('IP',null,['class' => 'col-form-label']) !!}
  {!! Form::text('ip',null,['class' => 'form-control']) !!}
</div>


<div class="form-group">
  {!! Form::submit($buttonText,['class'=>'btn btn-flat btn-success btn-lg btn-block']) !!}
</div>
