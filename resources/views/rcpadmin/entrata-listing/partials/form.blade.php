@if (isset($errors) && count($errors) > 0)
    <div id="card-alert" class="card red lighten-5">
        <div class="card-content red-text">

            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach

        </div>
    </div>
@endif

<div class="main-content-inner">
    <div class="row">
        <!-- nav tab start -->
        <div class="col-lg-12 mt-12">
            <div class="card">
                <div class="card-body">
                    <div class="tab-content mt-12 " id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-6 mb-6 clear">
                                        <h6>{!! Form::label('Owner/Landlord',null,['class' => 'col-form-label']) !!}</h6>
                                        <select class="custom-select" name="landlord_id" id="landLordId" required>
                                            <option value="0"> Select</option>
                                            <?php if(isset($listing['landlord'])):  ?>
                                            <?php foreach ($listing['landlord'] as $landlord): ?>
                                            <option value="<?= $landlord->id ?>"><?= $landlord->name; ?></option>
                                            <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-6 clear">
                                        <h6>{!! Form::label('Campus Name',null,['class' => 'col-form-label']) !!}</h6>
                                        <select class="custom-select" name="campus_id" id="" required>
                                            <option value=""> Select</option>
                                            <?php if (isset($listing['campus'])):  ?>
                                            <?php foreach ($listing['campus'] as $campus): ?>
                                            <option value="<?= $campus->id ?>"><?= $campus->title; ?></option>
                                            <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-6">
                                        <h6>{!! Form::label('Listing Title/Apartment Name',null,['class' => 'col-form-label']) !!}</h6>
                                        <input type="text" name="listing_title" value="<?= $listing['rentlinx']['name'] ?>"  class="form-control" placeholder="Apartment Name" required>
                                    </div>
                                    <div class="col-md-6 mb-6 clear">
                                        <h6>{!! Form::label('Property Type',null,['class' => 'col-form-label']) !!}</h6>
                                        <select class="custom-select" name="category_id" id="" required>
                                            <option value=""> Select</option>
                                            <?php if (isset($listing['category'])):  ?>
                                            <?php foreach ($listing['category'] as $category): ?>
                                            <option value="<?= $category->id ?>"><?= $category->name; ?></option>
                                            <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-6 clear">
                                        <h6>{!! Form::label('Address',null,['class' => 'input-group-text']) !!}</h6>
                                        <textarea name="address" id="" cols="30" rows="10"><?=  $listing['rentlinx']['address'] ? $listing['rentlinx']['address'] : '' ?></textarea>
                                    </div>
                                    <div class="col-md-6 mb-6 clear">
                                        <h6>{!! Form::label('Description',null,['class' => 'input-group-text']) !!}</h6>
                                        <textarea name="description" id="" cols="30" rows="10"><?= $listing['rentlinx']['description'] ? $listing['rentlinx']['description'] : ''  ?></textarea>
                                    </div>
                                    <div class="col-md-6 mb-6 clear">
                                        <h6>{!! Form::label('Contact Email(For This Property)',null,['class' => 'col-form-label']) !!}</h6>
                                        <input type="text" name="contact_email" value="<?= $listing['rentlinx']['email'] ?>" class="form-control" placeholder="Put Comma ( , ) to add multiple emails" required>
                                    </div>
                                    <div class="col-md-6 mb-6 clear">
                                        <h6>{!! Form::label('Contact Phone(For This Property)',null,['class' => 'col-form-label']) !!}</h6>
                                        <input type="text" name="contact_phone" value="<?= $listing['rentlinx']['phone'] ? $listing['rentlinx']['phone'] : '' ?>" class="form-control" placeholder="Only 1 Contact Number" required>
                                    </div>
                                    <div class="col-md-12 mb-6 clear">
                                        <h4>Listing Details</h4>
                                    </div>
                                    <div class="col-md-6 mb-6 clear" style="padding-top: 30px;">
                                        <label class="switch"><input name="payment" type="checkbox" id="togBtn">
                                            <div class="slider round">
                                                <!--ADDED HTML -->
                                                <span class="paid" >Paid</span>
                                                <span class="free">Free Trial</span>
                                                <!--END-->
                                            </div>
                                        </label>
                                    </div>
                                    <div class="col-md-6 mb-6 clear">
                                        <h6>{!! Form::label('Property Expiry',null,['class' => 'col-form-label']) !!}</h6>
                                        <input type="text" name="property_expiry" value="<?= date("Y-m-d") ?>"
                                               class="datePicker form-control"
                                               id="dateTo">
                                        <input type="hidden" name="property_id" value="{{$listing['rentlinx']['property_id']}}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-10 offset-md-1 mb-6">
                                    <button type="submit" class="btn btn-flat btn-success btn-sm">Save and Continue</button>
                                    <button class="btn btn-flat btn-sm"><a href="{{'../../rcpadmin/entrata'}}">Cancle</a></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
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
           $('#landLordId').on('change', function () {
              var landLord_id =  $('#landLordId').val();
           })
        });
    </script>
@stop