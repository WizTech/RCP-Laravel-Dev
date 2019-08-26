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
                                {{--<div class="form-row">
                                    <h4>Floor Plans</h4>
                                    <div class="col-md-12 mb-12 clear">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="text-center table">
                                                        <thead class="text-capitalize">
                                                        <tr>
                                                            <th> Name</th>
                                                            <th> Bed Rooms</th>
                                                            <th> Bath Rooms</th>
                                                            <th> Rent</th>
                                                            <th> Sq.Footage</th>
                                                            <th> Date Available</th>
                                                            <th> Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td> Lorem Ipsum</td>
                                                            <td> Lorem Ipsum</td>
                                                            <td> Lorem Ipsum</td>
                                                            <td> Lorem Ipsum</td>
                                                            <td> Lorem Ipsum</td>
                                                            <td> Lorem Ipsum</td>
                                                            <td> Lorem Ipsum</td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>--}}
                                <div class="form-row clear">
                                    <h4>Property Info</h4>
                                </div>
                                <?php // echo "<pre>"; print_r($data['listing']); die(); ?>
                                <div class="form-row">
                                    <div class="col-md-6 mb-6 clear">
                                        <h6>{!! Form::label('Owner/Landlord',null,['class' => 'col-form-label']) !!}</h6>
                                        <select name="landlord_id" class="custom-select" required>
                                            <?php if (isset($data['landlord'])):  ?>
                                            <?php foreach ($data['landlord'] as $landlord): ?>
                                            <?php if ($landlord->id == $data['listing']['landlord_id']): ?>
                                            <option value="<?= $landlord->id ?>"
                                                    selected><?= $landlord->name; ?></option>
                                            <?php else: ?>
                                            <option value="<?= $landlord->id ?>"><?= $landlord->name; ?></option>
                                            <?php endif; ?>
                                            <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-6 clear">
                                        <h6>{!! Form::label('Property Type',null,['class' => 'col-form-label']) !!}</h6>
                                        <select name="category_id" class="custom-select" required>
                                            <?php if (isset($data['category'])):  ?>
                                            <?php foreach ($data['category'] as $category): ?>
                                            <?php if ($category->id == $data['listing']['category_id']): ?>
                                            <option value="<?= $category->id ?>"
                                                    selected><?= $category->name; ?></option>
                                            <?php else: ?>
                                            <option value="<?= $category->id ?>"><?= $category->name; ?></option>
                                            <?php endif; ?>
                                            <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-6 clear">
                                        <h6>{!! Form::label('Campus Name',null,['class' => 'col-form-label']) !!}</h6>
                                        <select name="campus_id" class="custom-select" required>
                                            <?php if (isset($data['campus'])):  ?>
                                            <?php foreach ($data['campus'] as $campus): ?>
                                            <?php if ($campus->id == $data['listing']['campus_id']): ?>
                                            <option value="<?= $campus->id ?>"
                                                    selected><?php echo $campus->title ?></option>
                                            <?php else: ?>
                                            <option value="<?= $campus->id ?>"><?= $campus->title; ?></option>
                                            <?php endif; ?>
                                            <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-6 clear">
                                        <h6>{!! Form::label('Status',null,['class' => 'col-form-label']) !!}</h6>
                                        <select name="status" class="custom-select" required>
                                            <option value=""> Select</option>
                                            <option value="Active" <?= $data['listing']['status'] ? 'selected' : '' ?> >
                                                Active
                                            </option>
                                            <option value="Inactive" <?= $data['listing']['status'] ? 'selected' : '' ?> >
                                                Inactive
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-6 clear">
                                        <h6>{!! Form::label('Listing Title/Apartment Name',null,['class' => 'col-form-label']) !!}</h6>
                                        <input type="text" name="listing_title"
                                               value="<?= $data['listing']['title'] ? $data['listing']['title'] : '' ?>"
                                               class="form-control"
                                               placeholder="Apartment Name" required>
                                    </div>
                                    <div class="col-md-6 mb-6 clear">
                                        <h6>{!! Form::label('Units Number',null,['class' => 'col-form-label']) !!}</h6>
                                        <input type="text" name="units_number"
                                               value="<?= $data['listing']['units_number'] ? $data['listing']['units_number'] : ''  ?>"
                                               class="form-control"
                                               placeholder="Units Number" required>
                                    </div>
                                    <div class="col-md-6 mb-6 clear">
                                        <h6>{!! Form::label('Address',null,['class' => 'input-group-text']) !!}</h6>
                                        <textarea name="address" id="" cols="30"
                                                  rows="10"><?= $data['listing']['address'] ? $data['listing']['address'] : '' ?></textarea>
                                    </div>
                                    <div class="col-md-6 mb-6 clear">
                                        <h6>{!! Form::label('Description',null,['class' => 'input-group-text']) !!}</h6>
                                        <textarea name="description" id="" cols="30"
                                                  rows="10"><?= $data['listing']['description'] ? $data['listing']['description'] : '' ?></textarea>
                                    </div>
                                    <div class="col-md-6 mb-6 clear">
                                        <h6>{!! Form::label('Contact Email(For This Property)',null,['class' => 'col-form-label']) !!}</h6>
                                        <input type="text" name="contact_email" value="<?= $data['listing']['email'] ?>"
                                               class="form-control"
                                               placeholder="Put Comma ( , ) to add multiple emails" required>
                                    </div>
                                    <div class="col-md-6 mb-6 clear">
                                        <h6>{!! Form::label('Contact Phone(For This Property)',null,['class' => 'col-form-label']) !!}</h6>
                                        <input type="text" name="contact_phone" value="<?= $data['listing']['phone'] ?>"
                                               class="form-control"
                                               placeholder="Only 1 Contact Number" required>
                                    </div>
                                    <div class="col-md-6 mb-6 clear">
                                        <h6>{!! Form::label('Double Feature Ordering',null,['class' => 'col-form-label']) !!}</h6>
                                        <select class="custom-select" name="double_feature_ordering">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="non" selected>Non Double Feature</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-6 clear">
                                        <h6>{!! Form::label(' Twilio Number (For This Property)',null,['class' => 'col-form-label']) !!}</h6>
                                        <input type="text" name="twilio_number"
                                               value="<?= $data['listing']['twilio_number'] ? $data['listing']['twilio_number'] : '' ?>"
                                               class="form-control"
                                               placeholder="Only 1 Twilio Number" required>
                                    </div>
                                    <div class="col-md-6 mb-6 clear">
                                        <h6>{!! Form::label('Double Feature Expiry',null,['class' => 'col-form-label']) !!}</h6>
                                        <input type="text" name="double_feature_expiry"
                                               value="<?= $data['listing']['double_feature_expiry_date'] ? $data['listing']['double_feature_expiry_date'] : date("Y-m-d") ?>"
                                               class="datePicker form-control" placeholder="Double Feature Expiry"
                                               required>
                                    </div>
                                    <div class="col-md-6 mb-6 clear">
                                        <h6>{!! Form::label('Landlord Website (For This Property)',null,['class' => 'col-form-label']) !!}</h6>
                                        <input type="text" name="landlord_website" class="form-control"
                                               placeholder="Landlord Website for this property" required>
                                    </div>
                                    <div class="col-md-6 mb-6 clear" style="padding-top: 30px;">
                                        <h5>{!! Form::label(' Topspot Paid/Free Trail',null,['class' => 'col-form-label clear']) !!}</h5>
                                        <label class="switch"><input name="payment" type="checkbox" id="togBtn">
                                            <div class="slider round">
                                                <!--ADDED HTML -->
                                                <span class="paid">Paid</span>
                                                <span class="free">Free Trial</span>
                                                <!--END-->
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-row clear">
                                    <h4> Special </h4>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6 mb-6 clear">
                                        <h6>{!! Form::label('Special Expiry',null,['class' => 'col-form-label']) !!}</h6>
                                        <input type="text" name="special_expiry"
                                               value="<?= isset($data['special_expiry']['special_expiry']) ? $data['special_expiry']['special_expiry'] : date("Y-m-d") ?>"
                                               class="datePicker form-control" placeholder="Special Expiry" required>
                                    </div>
                                    <div class="col-md-12 mb-12 clear">
                                        <h6>{!! Form::label('Details',null,['class' => 'input-group-text']) !!}</h6>
                                        <textarea name="details" id="" cols="30"
                                                  rows="10"><?= isset($data['listing']['special']) ? $data['listing']['special'] : '' ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row clear">
                                <h4> Email Imitation </h4>
                            </div>
                            <div class="form-row clear">
                                <div class="col-md-6 mb-6 clear" style="padding-top: 30px;">
                                    <h6>{!! Form::label(' Topspot Paid/Free Trail',null,['class' => 'col-form-label clear']) !!}</h6>
                                    <label class="switch"><input name="payment" type="checkbox" id="togBtn">
                                        <div class="slider round">
                                            <!--ADDED HTML -->
                                            <span class="paid">No</span>
                                            <span class="free">Yes</span>
                                            <!--END-->
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <div class="form-row clear">
                                <h4> Listing Details </h4>
                            </div>
                            <div class="form-row clear">
                                <div class="col-md-6 mb-6 clear" style="padding-top: 30px;">
                                    <h6>{!! Form::label(' Topspot Paid/Free Trail',null,['class' => 'col-form-label clear']) !!}</h6>
                                    <label class="switch"><input name="payment" type="checkbox" id="togBtn">
                                        <div class="slider round">
                                            <!--ADDED HTML -->
                                            <span class="paid">Paid</span>
                                            <span class="free">Free Trial</span>
                                            <!--END-->
                                        </div>
                                    </label>
                                </div>
                                <div class="col-md-6 mb-6 clear">
                                    <h6>{!! Form::label('Property Expiry',null,['class' => 'col-form-label']) !!}</h6>
                                    <input type="text" name="property_expiry"
                                           value="<?= $data['listing']['property_expiry_date'] ? $data['listing']['property_expiry_date'] : date("Y-m-d") ?>"
                                           class="datePicker form-control" required>
                                    <input type="hidden" name="_method" value="PUT">
                                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                    <input type="hidden" name="rentlinx_listing_id"
                                           value="<?= $data['listing']['entrata_listing_id'] ?>">
                                </div>
                            </div>
                            <div class="form-row clear"></div>
                            <div class="form-row clear">
                                <div class="col-md-10 offset-md-1 mb-6">
                                    <button type="submit" class="btn btn-flat btn-success btn-sm">Save and Continue
                                    </button>
                                    <button class="btn btn-flat btn-sm"><a href="{{'../../rcpadmin/entrata-listing'}}">Cancle</a>
                                    </button>
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
@stop