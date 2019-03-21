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
  {!! Form::label('Name',null,['class' => 'col-form-label']) !!}
  {!! Form::text('name',null,['class' => 'form-control']) !!}
</div>
<div class="form-group">
  {!! Form::label('Floorplans Allowed?',null,['class' => 'col-form-label']) !!}
  {!! Form::text('floorplans_allowed',null,['class' => 'form-control']) !!}
</div>

<div class="form-group">
  {!! Form::label('One Month Price',null,['class' => 'col-form-label']) !!}
  {!! Form::text('price_one_month',null,['class' => 'form-control']) !!}
</div>
<div class="form-group">
  {!! Form::label('Six Month Price',null,['class' => 'col-form-label']) !!}
  {!! Form::text('price_six_month',null,['class' => 'form-control']) !!}
</div>

<div class="form-group">
  {!! Form::select('status',[''=>'Status','Active'=>'ACTIVE','Inactive'=>'INACTIVE'],null,['class' => 'custom-select']) !!}
</div>


<div class="form-group">

  {!! Form::submit($buttonText,['class'=>'btn btn-flat btn-success btn-lg btn-block']) !!}
</div>
