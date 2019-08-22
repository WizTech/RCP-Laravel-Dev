@if (isset($errors) && count($errors) > 0)


  <div id="card-alert" class="card red lighten-5">
    <div class="card-content red-text">


      @foreach ($errors->all() as $error)
        <p>{{ $error }}</p>
      @endforeach

    </div>
  </div>
@endif
@if($buttonText == 'Add Sublease')
  {!! Form::hidden('student_id',$id) !!}
@else
  {!! Form::hidden('id',$id) !!}
  {!! Form::hidden('student_id',$sublease['student_id']) !!}
@endif

<h5>General Information</h5>
<hr>
<div class="form-row">
  <div class="col-md-12 mb-12">
       {!! Form::label('Campus',null,['class' => 'col-form-label']) !!}
       {!! Form::select('campus_id',[$campusSelect],null,['class' => 'custom-select']) !!}
       {{--{!! Form::select('campus_id[]',$campusSelect,$user_campuses,
                     ['class' => 'custom-select materialSelect', 'multiple']) !!}--}}
     </div>
  <div class="col-md-12 mb-12">
    {!! Form::label('Title',null,['class' => 'col-form-label']) !!}
    {!! Form::text('title',null,['class' => 'form-control']) !!}
  </div>
  <div class="col-md-12 mb-12">
    {!! Form::label('Description',null,['class' => 'col-form-label']) !!}
    {!! Form::textarea('description',null,['class' => 'form-control']) !!}
  </div>
</div>
<h5>Property Information</h5>
<hr>
<div class="form-row">

  <hr>
  <div class="col-md-4 mb-4">
    {!! Form::label('Property Type',null,['class' => 'col-form-label']) !!}
    {!! Form::select('property_type',['1'=>'Apartment Building','2'=>'Room','3'=>'House'],null,['class' => 'custom-select']) !!}

  </div>
  <div class="col-md-4 mb-4">
    {!! Form::label('Bedroom',null,['class' => 'col-form-label']) !!}
    {!! Form::select('bedrooms',['1'=>'1 Bedroom','2'=>'2 Bedroom','3'=>'3 Bedroom','4'=>'4 Bedroom'],null,['class' => 'custom-select']) !!}

  </div>
  <div class="col-md-4 mb-4">
    {!! Form::label('Bathroom',null,['class' => 'col-form-label']) !!}
    {!! Form::select('bathrooms',['1'=>'1 Bathroom','2'=>'2 Bathroom','3'=>'3 Bathroom','4'=>'4 Bathroom'],null,['class' => 'custom-select']) !!}

  </div>

  <div class="col-md-4 mb-4">
    {!! Form::label('Apartment Name',null,['class' => 'col-form-label']) !!}
    {!! Form::text('aparment',null,['class' => 'form-control']) !!}
  </div>
  <div class="col-md-4 mb-4">
    {!! Form::label('Address',null,['class' => 'col-form-label']) !!}
    {!! Form::text('address',null,['class' => 'form-control']) !!}
  </div>
  <div class="col-md-4 mb-4">
    {!! Form::label('Rent',null,['class' => 'col-form-label']) !!}
    {!! Form::text('rent',null,['class' => 'form-control']) !!}

  </div>
</div>
<h5>Contact Information</h5>
<hr>
<div class="form-row">

  <div class="col-md-12 mb-12">
    {!! Form::label('Email',null,['class' => 'col-form-label']) !!}
    {!! Form::text('email_id',null,['class' => 'form-control']) !!}
  </div>
  <div class="col-md-12 mb-12">
    {!! Form::label('First Name',null,['class' => 'col-form-label']) !!}
    {!! Form::text('first_name',null,['class' => 'form-control']) !!}
  </div>

  <div class="col-md-12 mb-12">
    {!! Form::label('Last Name',null,['class' => 'col-form-label']) !!}
    {!! Form::text('last_name',null,['class' => 'form-control']) !!}
  </div>
</div>
<div class="form-group">
  {!! Form::submit($buttonText,['class'=>'btn btn-flat btn-success btn-lg btn-block']) !!}

</div>


