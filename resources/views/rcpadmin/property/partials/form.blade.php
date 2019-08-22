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
        <div class="col-md-3 mb-2">
            {!! Form::label('Campus',null,['class' => 'col-form-label']) !!}
            {!! Form::select('campus_id',$campusSelect,null,['class' => 'custom-select']) !!}
        </div>
        <div class="col-md-3 mb-2">
            {!! Form::label('Category',null,['class' => 'col-form-label']) !!}
            {!! Form::select('category_id',$categorySelect,null,['class' => 'custom-select']) !!}
        </div>
        <div class="col-md-3 mb-2">
            {!! Form::label('Landlord',null,['class' => 'col-form-label']) !!}
            {!! Form::select('landlord_id',$usersSelect,null,['class' => 'custom-select']) !!}
        </div>
        <div class="col-md-3 mb-2">
            {!! Form::label('Status',null,['class' => 'col-form-label']) !!}
            {!! Form::select('status',['Active'=>'ACTIVE','Inactive'=>'INACTIVE'],null,['class' => 'custom-select']) !!}

        </div>
        <div class="col-md-3 mb-2">
            {!! Form::label('Listing Title',null,['class' => 'col-form-label']) !!}
            {!! Form::text('title',null,['class' => 'form-control']) !!}
        </div>
        <div class="input-field col-md-3 mb-2 col s12">
            {!! Form::label('Address',null,['class' => 'col-form-label']) !!}
            {!! Form::text('address',null,['class' => 'form-control']) !!}
        </div>
        <div class="col-md-3 mb-2">
            {!! Form::label('Email',null,['class' => 'col-form-label']) !!}
            {!! Form::text('email',null,['class' => 'form-control','placeholder'=>'put comma ( , ) to add multiple emails']) !!}
        </div>

        <div class="col-md-3 mb-2">
            {!! Form::label('Phone',null,['class' => 'col-form-label']) !!}
            {!! Form::text('phone',null,['class' => 'form-control']) !!}
        </div>
        <div class="col-md-3 mb-3">
            {!! Form::label('Type of listing',null,['class' => 'col-form-label']) !!}
            {!! Form::select('free_trial',['ACTIVE'=>'ACTIVE','INACTIVE'=>'INACTIVE'],null,['class' => 'custom-select']) !!}
        </div>
        <div class="col-md-3 mb-3">
            {!! Form::label('Rent Style',null,['class' => 'col-form-label']) !!}
            {!! Form::select('pricing',['per_unit'=>'Per Unit','per_bed'=>'Per Bed'],null,['class' => 'custom-select']) !!}
        </div>
        <div class="col-md-3 mb-3">
            {!! Form::label('Double Featured',null,['class' => 'col-form-label']) !!}
            {!! Form::select('double_featured',['INACTIVE'=>'INACTIVE','ACTIVE'=>'ACTIVE'],null,['class' => 'custom-select double_featured']) !!}
            {!! Form::text('double_featured_order',null,['class' => 'form-control hide double_featured_order','placeholder' => 'Rank']) !!}
        </div>
        <div class="col-md-3 mb-3">
            {!! Form::label('Twilio Number',null,['class' => 'col-form-label']) !!}
            {!! Form::text('twilio_number',null,['class' => 'form-control']) !!}
        </div>
        <div class="col-md-3 mb-3">
            {!! Form::label('Units Number',null,['class' => 'col-form-label']) !!}
            {!! Form::text('units_number',null,['class' => 'form-control']) !!}
        </div>
        <div class="col-md-3 mb-2">
            {!! Form::label('Property Expiry',null,['class' => 'col-form-label']) !!}
            {!! Form::text('property_expiry_date',null,['class' => 'datePicker form-control']) !!}
        </div>
        <div class="col-md-6 mb-4">
            {!! Form::label('Description',null,['class' => 'input-group-text']) !!}
            {!! Form::textarea('description',null,['class' => 'form-control']) !!}
        </div>

    </div>
    <div class="form-row">
        <div class="col-md-6 mb-4">
            {!! Form::label('Special Details',null,['class' => 'input-group-text']) !!}
            {!! Form::textarea('special',null,['class' => 'form-control']) !!}
        </div>
        <div class="col-md-3 mb-2">
            {!! Form::label('Special Expiry',null,['class' => 'col-form-label']) !!}
            {!! Form::text('special_expiry',null,['class' => 'datePicker form-control']) !!}
        </div>
    </div>
</div>

<div class="form-group">
    <div class="col-md-12 mb-12">
        {!! Form::submit($buttonText,['class'=>'btn btn-flat btn-success btn-lg btn-block']) !!}
    </div>
</div>

@section('scripts')
    <!-- data-tables -->

    <!-- Start datatable js -->
    <script src="{{ env('THEME_ASSETS_NEW') }}assets/chosen-bootstrap/chosen/chosen.jquery.min.js"></script>

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

        $(document).ready(function () {
            $('select.double_featured').on('change', function () {
                if ($(this).val() == 'ACTIVE') {
                    $('.double_featured_order').removeClass('hide');
                } else {
                    $('.double_featured_order').addClass('hide');
                }

            });

        });

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
@stop