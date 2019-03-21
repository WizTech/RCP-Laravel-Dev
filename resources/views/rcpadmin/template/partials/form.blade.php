@if (isset($errors) && count($errors) > 0)
  <div id="card-alert" class="card red lighten-5">
    <div class="card-content red-text">


      @foreach ($errors->all() as $error)
        <p>{{ $error }}</p>
      @endforeach

    </div>
  </div>
@endif
@if(isset($template['body']) && !empty($template['body']))
  @php $body = $template['body']; @endphp

@else
  @php $body = ''; @endphp

@endif
<div class="form-group">
  {!! Form::label('Name',null,['class' => 'col-form-label']) !!}
  {!! Form::text('name',null,['class' => 'form-control']) !!}
</div>
<div class="form-group">
  {!! Form::label('Subject',null,['class' => 'col-form-label']) !!}
  {!! Form::text('subject',null,['class' => 'form-control']) !!}
</div>
<div class="input-group">
 {{-- <div class="input-group-prepend">
                                                     <span class="input-group-text">With textarea</span>
                                                 </div>--}}
  {!! Form::label('Body',null,['class' => 'input-group-text']) !!}
  {!! Form::textarea('body',$body,['class' => 'form-control']) !!}
</div>
<div class="form-group">
  {!! Form::label('Slug',null,['class' => 'col-form-label']) !!}
  {!! Form::text('slug',null,['class' => 'form-control']) !!}
</div>
<div class="form-group">

  {!! Form::submit($buttonText,['class'=>'btn btn-flat btn-success btn-lg btn-block']) !!}
</div>