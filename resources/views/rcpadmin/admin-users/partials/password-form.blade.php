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
        {!! Form::password('current_password',['class' => 'form-control']) !!}
    </div>
    <div class="col-md-12 mb-12">
        {!! Form::label('New Password',null,['class' => 'col-form-label']) !!}
        {!! Form::password('password',['class' => 'form-control', 'id' => 'password']) !!}
    </div>
    <div class="col-md-12 mb-12">
        {!! Form::label('Confirm Password',null,['class' => 'col-form-label']) !!} <i id="message"></i>
        {!! Form::password('password_confirmation',['class' => 'form-control', 'id' => 'confirm_password']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::submit($buttonText,['class'=>'btn btn-flat btn-success btn-lg btn-block']) !!}
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#confirm_password').on('keyup', function () {
            if ($('#password').val() == $('#confirm_password').val()) {
                $('#message').html('').css('color', 'green');
            } else
                $('#message').html(' (Password Not Matched) ').css('color', 'red');
        });
    });
</script>



