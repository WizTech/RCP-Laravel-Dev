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


    <div class="col-md-6 mb-6">
      {!! Form::label('Name',null,['class' => 'col-form-label']) !!}
      {!! Form::text('name',null,['class' => 'form-control']) !!}
    </div>
    <div class="col-md-6 mb-6">
      {!! Form::label('Position',null,['class' => 'col-form-label']) !!}
      {!! Form::text('position',null,['class' => 'form-control']) !!}
    </div>
    <div class="col-md-6 mb-6">
      {!! Form::file('photo',null,['class' => 'custom-file-label']) !!}
      @if (!empty($user['photo']))

        <img style="float: right;" height="60" width="60"

             src="{{ env('APP_URL').'public/storage/team/'.$user['photo']}}">

      @endif
    </div>

  </div>
</div>
<div class="form-group">
  <div class="col-md-12 mb-12">
    {!! Form::submit($buttonText,['class'=>'btn btn-flat btn-success btn-lg btn-block']) !!}
  </div>
</div>
