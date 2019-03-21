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
  {!! Form::hidden('id') !!}

    {!! Form::select('role_id',[''=>'User Type','1'=>'Super Admin','2'=>'Admin'],null,['class' => 'custom-select']) !!}

</div>
<div class="form-group">

    {!! Form::label('Name',null,['class' => 'col-form-label']) !!}
    {!! Form::text('name',null,['class' => 'form-control']) !!}

</div>
<div class="form-group">

    {!! Form::label('Username',null,['class' => 'col-form-label']) !!}
    {!! Form::text('username',null,['class' => 'form-control']) !!}

</div>
<div class="form-group">
    {!! Form::label('Email',null,['class' => 'col-form-label']) !!}
    {!! Form::text('email',null,['class' => 'form-control']) !!}

</div>
<div class="form-group">

    {!! Form::label('Password',null,['class' => 'col-form-label']) !!}
    {!! Form::password('password',['class' => 'form-control']) !!}

</div>


<div class="form-group">
    {!! Form::select('campus_id[]',$campusSelect,$admin_campuses,
        ['class' => 'form-control',
        'multiple' => 'multiple']) !!}

</div>
<div class="form-group">

    {!! Form::select('export_all_leads',[''=>'Export All Leads','Yes'=>'Yes','No'=>'No'],null,['class' => 'custom-select']) !!}

</div>
<div class="form-group">
    {!! Form::select('status',[''=>'Status','Active'=>'Active','Inactive'=>'Inactive'],null,['class' => 'custom-select']) !!}

</div>
<div class="form-group">
    {!! Form::submit($buttonText,['class'=>'btn btn-flat btn-success btn-lg btn-block']) !!}

</div>


