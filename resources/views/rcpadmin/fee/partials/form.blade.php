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
  {!! Form::label('Reason of Fees',null,['class' => 'col-form-label']) !!}
  {!! Form::text('reason',null,['class' => 'form-control']) !!}
</div>
<div class="form-group">
  {!! Form::label('Amount',null,['class' => 'col-form-label']) !!}
  {!! Form::number('amount',null,['class' => 'form-control']) !!}
</div>
<div class="form-group">
  {!! Form::submit($buttonText,['class'=>'btn btn-flat btn-success btn-lg btn-block']) !!}
</div>
