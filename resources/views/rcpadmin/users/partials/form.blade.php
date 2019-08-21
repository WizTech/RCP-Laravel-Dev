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

    <h5> Account Details </h5>
    <div class="form-row">
        <div class="col-md-4 mb-3">
            {!! Form::hidden('id') !!}
            {!! Form::hidden('role') !!}
            {!! Form::label('User Type',null,['class' => 'col-form-label']) !!}
            {!! Form::select('role',['3'=>'Landlord','2'=>'Student'],null,['class' => 'custom-select roleId']) !!}
        </div>
        <div class="col-md-4 mb-3">
            {!! Form::label('status',null,['class' => 'col-form-label']) !!}
            {!! Form::select('status',['Active'=>'ACTIVE','Inactive'=>'INACTIVE'],null,['class' => 'custom-select']) !!}
        </div>
        <div class="col-md-4 mb-3">
            {!! Form::label('Campus',null,['class' => 'col-form-label']) !!}
            {!! Form::select('campus_id',[$campusSelect],null,['class' => 'custom-select']) !!}
            {{--{!! Form::select('campus_id[]',$campusSelect,$user_campuses,
                          ['class' => 'custom-select materialSelect', 'multiple']) !!}--}}
        </div>
        <div class="col-md-4 mb-3">
            {!! Form::label('Username',null,['class' => 'col-form-label']) !!}
            {!! Form::text('name',null,['class' => 'form-control']) !!}
        </div>
        <div class="col-md-4 mb-3">
            {!! Form::label('Password',null,['class' => 'col-form-label']) !!}
            {!! Form::password('password',['class' => 'form-control','id'=>'password']) !!}
        </div>
        <div class="col-md-4 mb-3">
            {!! Form::label('Confirm Password',null,['class' => 'col-form-label']) !!}  <i id="message"></i>
            {!! Form::password('password_confirmation',['class' => 'form-control','id'=>'confirm_password']) !!}
        </div>
        <div class="col-md-4 mb-3">
            {!! Form::hidden('id') !!}
            {!! Form::label('Which type of Landlord are you ?',null,['class' => 'col-form-label']) !!}
            {!! Form::select('type',['Personal'=>'Personal','Company'=>'Company'],null,['class' => 'custom-select']) !!}
        </div>
        <div class="col-md-4 mb-3">
            {!! Form::label('Free/Paid (Applicable only for Landlord)',null,['class' => 'col-form-label']) !!}
            {!! Form::select('free_trial',['Free'=>'Free','Paid'=>'Paid'],null,['class' => 'custom-select']) !!}
        </div>
        <div class="col-md-4 mb-3">
            {!! Form::label('Premium Landlord',null,['class' => 'col-form-label']) !!}
            {!! Form::select('preimum',['ACTIVE'=>'ACTIVE','INACTIVE'=>'INACTIVE'],null,['class' => 'custom-select']) !!}
        </div>
    </div>

    <h5> Landlord Details </h5>
    <div class="form-row">
        <div class="col-md-4 mb-3">
            {!! Form::label('First Name',null,['class' => 'col-form-label']) !!}
            {!! Form::text('first_name',null,['class' => 'form-control']) !!}
        </div>
        <div class="col-md-4 mb-3">
            {!! Form::label('Last Name',null,['class' => 'col-form-label']) !!}
            {!! Form::text('last_name',null,['class' => 'form-control']) !!}
        </div>
        <div class="col-md-4 mb-3">
            {!! Form::label('Email',null,['class' => 'col-form-label']) !!}
            {!! Form::text('email',null,['class' => 'form-control']) !!}
        </div>
        <div class="col-md-4 mb-3">
            {!! Form::label('Phone',null,['class' => 'col-form-label']) !!}
            {!! Form::text('phone_no',null,['class' => 'form-control']) !!}

        </div>
        <div class="col-md-4 mb-3">
            {!! Form::label('Fax',null,['class' => 'col-form-label']) !!}
            {!! Form::text('fax',null,['class' => 'form-control']) !!}
        </div>
        <div class="col-md-4 mb-3">
            {!! Form::label('Address',null,['class' => 'col-form-label']) !!}
            {!! Form::text('address',null,['class' => 'form-control']) !!}
        </div>
        <div class="col-md-4 mb-3">
            {!! Form::label('Website',null,['class' => 'col-form-label']) !!}
            {!! Form::text('website',null,['class' => 'form-control']) !!}
        </div>
        <div class="col-md-4 mb-3">
            {!! Form::label('Company',null,['class' => 'col-form-label']) !!}
            {!! Form::text('company',null,['class' => 'form-control']) !!}
        </div>
    </div>
</div>
<h5> Account Features </h5>
<div class="hide landlord-form form-group">
    <div class="form-row">
        <div class="col-md-4 mb-3">
            {!! Form::label('Email Type',null,['class' => 'col-form-label']) !!}
            {!! Form::text('email_type',null,['class' => 'form-control']) !!}
        </div>
        <div class="col-md-4 mb-3">
            {!! Form::label('Property Email Leads',null,['class' => 'col-form-label']) !!}
            {!! Form::select('email_leads',['ACTIVE'=>'ACTIVE','INACTIVE'=>'INACTIVE'],null,['class' => 'custom-select']) !!}
        </div>
        <divs class="col-md-4 mb-3">
            {!! Form::label('Rent Style',null,['class' => 'col-form-label']) !!}
            {!! Form::select('rent_style',['per_person'=>'Per Person','per_unit'=>'Per Unit'],null,['class' => 'custom-select']) !!}
        </divs>
        <div class="col-md-4 mb-3">
            {!! Form::label('Activate Twilio',null,['class' => 'col-form-label']) !!}
            {!! Form::select('activate_twilio',['ACTIVE'=>'ACTIVE','INACTIVE'=>'INACTIVE'],null,['class' => 'custom-select activate_twilio']) !!}
            {!! Form::text('twilio_number',null,['class' => 'form-control hide twilio_number','placeholder' => 'Twilio Number']) !!}
        </div>
        <div class="col-md-4 mb-3">
            {!! Form::label('Landlord\'s Dashboard Link',null,['class' => 'col-form-label']) !!}
            {!! Form::select('landlord_dashboard_status',['ACTIVE'=>'ACTIVE','INACTIVE'=>'INACTIVE'],null,['class' => 'custom-select']) !!}
        </div>
        <div class="col-md-4 mb-3">
            {!! Form::label('Landlord Website',null,['class' => 'col-form-label']) !!}
            {!! Form::text('landlord_website',null,['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-row">
        <h5> Integrations </h5>
    </div>
    <div class="form-row">
        <div class="col-md-4 mb-3">
            {!! Form::label('Yardi Landlord?',null,['class' => 'col-form-label']) !!}
            {!! Form::select('is_yardi',['ACTIVE'=>'ACTIVE','INACTIVE'=>'INACTIVE'],null,['class' => 'custom-select is_yardi']) !!}
            {!! Form::text('yardi_user_id',null,['class' => 'form-control hide yardi_user_id','placeholder' => 'Yardi ID']) !!}
        </div>
        <div class="col-md-4 mb-3">
            {!! Form::label('Entrata Landlord?',null,['class' => 'col-form-label']) !!}
            {!! Form::select('is_entrata',['ACTIVE'=>'ACTIVE','INACTIVE'=>'INACTIVE'],null,['class' => 'custom-select is_entrata']) !!}
            {!! Form::text('entrata_client_id',null,['class' => 'form-control hide entrata_client_id','placeholder' => 'Client ID']) !!}
        </div>
        <div class="col-md-4 mb-3">
            {!! Form::label('Lease Signing Options',null,['class' => 'col-form-label']) !!}
            {!! Form::select('lease_singing_options',['ACTIVE'=>'ACTIVE','INACTIVE'=>'INACTIVE'],null,['class' => 'custom-select emma_trial_landlord']) !!}
        </div>
        <div class="col-md-4 mb-3">
            {!! Form::label('Emma Trial Landlord?',null,['class' => 'col-form-label']) !!}
            {!! Form::select('emma_trial_landlord',['ACTIVE'=>'ACTIVE','INACTIVE'=>'INACTIVE'],null,['class' => 'custom-select emma_trial_landlord']) !!}
        </div>
        <div class="col-md-4 mb-3">
            {!! Form::label('Domain',null,['class' => 'col-form-label']) !!}
            {!! Form::text('domain_name',null,['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-row">
        <div class="col-md-4 mb-3">
            {!! Form::label('H1',null,['class' => 'col-form-label']) !!}
            {!! Form::text('h1',null,['class' => 'form-control']) !!}
        </div>
        <div class="col-md-4 mb-3">
            {!! Form::label('H2',null,['class' => 'col-form-label']) !!}
            {!! Form::text('h2',null,['class' => 'form-control']) !!}
        </div>
        <div class="col-md-4 mb-3">
            {!! Form::label('Meta Title',null,['class' => 'col-form-label']) !!}
            {!! Form::text('meta_title',null,['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-row">
        <div class="col-md-4 mb-3">
            <div class="input-group">
                {!! Form::label('Seo Block',null,['class' => 'input-group-text']) !!}
                {!! Form::textarea('seo_block',null,['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="input-group">
                {!! Form::label('About Details',null,['class' => 'input-group-text']) !!}
                {!! Form::textarea('about_details',null,['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="input-group">{!! Form::label('Meta Description',null,['class' => 'input-group-text']) !!}
                {!! Form::textarea('meta_description',null,['class' => 'form-control']) !!}</div>
        </div>
    </div>


</div>
<div class="form-group">
    {!! Form::submit($buttonText,['class'=>'btn btn-flat btn-success btn-lg btn-block']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('select.roleId').on('change', function () {
                if ($(this).val() == '3') {
                    $('.landlord-form').removeClass('hide');
                } else {
                    $('.landlord-form').addClass('hide');
                }

            });
            $('select.activate_twilio').on('change', function () {
                if ($(this).val() == 'ACTIVE') {
                    $('.twilio_number').removeClass('hide');
                } else {
                    $('.twilio_number').addClass('hide');
                }

            });

            $('select.is_entrata').on('change', function () {
                if ($(this).val() == 'ACTIVE') {
                    $('.entrata_client_id').removeClass('hide');
                } else {
                    $('.entrata_client_id').addClass('hide');
                }
            });

            $('select.is_yardi').on('change', function () {
                if ($(this).val() == 'ACTIVE') {
                    $('.yardi_user_id').removeClass('hide');
                } else {
                    $('.yardi_user_id').addClass('hide');
                }

            });
        });
        $(window).load(function () {
            $('select.roleId').trigger('change');
            $('select.activate_twilio').trigger('change');
            $('select.is_entrata').trigger('change');
            $('select.is_yardi').trigger('change');
        })
    </script>

    <script>
        jQuery.browser = {};
        (function () {
            jQuery.browser.msie = false;
            jQuery.browser.version = 0;
            if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
                jQuery.browser.msie = true;
                jQuery.browser.version = RegExp.$1;
            }
        })();
        $('.chosen').chosen({width: "100%"});

    </script>

    <script src="{{ env('ASSETS_PATH') }}tinymce/tinymce.min.js"></script>
    <script>

        $(document).ready(function () {


            tinymce.remove();
            tinyMCE.PluginManager.add('stylebuttons', function (editor, url) {
                ['pre', 'p', 'code', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6'].forEach(function (name) {
                    editor.addButton("style-" + name, {
                        tooltip: "Toggle " + name,
                        text: name.toUpperCase(),
                        onClick: function () {
                            editor.execCommand('mceToggleFormat', false, name);
                        },
                        onPostRender: function () {
                            var self = this, setup = function () {
                                editor.formatter.formatChanged(name, function (state) {
                                    self.active(state);
                                });
                            };
                            editor.formatter ? setup() : editor.on('init', setup);
                        }
                    })
                });
            });
            tinymce.init({

                selector: "textarea",

                theme: "modern",

                width: "100%",

                height: "100%",

                relative_urls: false,

                remove_script_host: false,


                plugins: [

                    "stylebuttons advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",

                    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",

                    "save table contextmenu directionality template paste textcolor"/*responsivefilemanager*/

                ],


                /*  content_css: "css/content.css",*/

                toolbar: "insertfile undo redo | styleselect | style-h1 style-h2 style-h3 style-h4 style-h5 style-h6 | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | responsivefilemanager |  media fullpage | forecolor backcolor",

                style_formats: [

                    {title: 'Bold text', inline: 'b'},

                    {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},

                    {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},

                    {title: 'Example 1', inline: 'span', classes: 'example1'},

                    {title: 'Example 2', inline: 'span', classes: 'example2'},

                    {title: 'Table styles'},

                    {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}

                ],

                filemanager_title: "File Manager"


            });


        })
    </script>

    <script>
        $(document).ready(function () {
            $('#confirm_password').on('keyup', function () {
                if ($('#password').val() == $('#confirm_password').val()) {
                    $('#message').html('').css('color', 'green');
                } else
                    $('#message').html(' (Password Not Matched) ').css('color', 'red');
            });
        });
    </script>
@stop