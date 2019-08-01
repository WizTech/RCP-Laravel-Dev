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
                  @if (!empty($user['logo_top']))
                    {!! Form::hidden('logo_top',$user['logo_top']) !!}
                    <div class="col-md-6 mb-6">

                      <h6>{!! Form::label(' Logo Top ',null,['class' => 'col-form-label']) !!}
                        {!! Form::file('logo_top',null,['class' => 'custom-file-label']) !!}
                        <span>
                                                                           <img style="float: inside;" height="60"
                                                                                width="60"
                                                                                src="{{ env('APP_URL').'public/storage/web/'.$user['logo_top']}}">
                                                                    </span></h6>
                    </div>

                  @else
                    <div class="col-md-6 mb-6">
                      <h6>{!! Form::label('Logo Top',null,['class' => 'col-form-label']) !!}</h6>
                      {!! Form::file('logo_top',null,['class' => 'custom-file-label']) !!}
                    </div>

                  @endif


                  @if (!empty($user['logo_bottom']))
                      {!! Form::hidden('logo_bottom',$user['logo_bottom']) !!}
                    <div class="col-md-6 mb-6">
                      <h6>{!! Form::label(' Logo Bottom ',null,['class' => 'col-form-label']) !!}
                        {!! Form::file('logo_bottom',null,['class' => 'custom-file-label']) !!}
                        <span>
                                                                                               <img
                                                                                                 style="float: inside;"
                                                                                                 height="60"
                                                                                                 width="60"
                                                                                                 src="{{ env('APP_URL').'public/storage/web/'.$user['logo_bottom']}}">
                                                                                           </span></h6>
                    </div>

                  @else

                    <div class="col-md-6 mb-6">
                      <h6>{!! Form::label('Logo Bottom',null,['class' => 'col-form-label']) !!}</h6>
                      {!! Form::file('logo_bottom',null,['class' => 'custom-file-label']) !!}
                    </div>
                  @endif

                  @if (!empty($user['slider_image_one']))
                      {!! Form::hidden('slider_image_one',$user['slider_image_one']) !!}
                    <div class="col-md-6 mb-6">
                      <h6>{!! Form::label(' Slider Image ',null,['class' => 'col-form-label']) !!}{!! Form::file('slider_image_one',null,['class' => 'custom-file-label']) !!}
                        <span>
                                                                                            <img style="float: inside;"
                                                                                                 height="60"
                                                                                                 width="60"
                                                                                                 src="{{ env('APP_URL').'public/storage/web/'.$user['logo_top']}}">
                                                                                        </span></h6>
                    </div>

                  @else
                    <div class="col-md-6 mb-6">
                      <h6>{!! Form::label('Slider Image',null,['class' => 'col-form-label']) !!}</h6>
                      {!! Form::file('slider_image_one',null,['class' => 'custom-file-label']) !!}
                    </div>

                  @endif


                  <div class="col-md-6 mb-6">
                    <h6>{!! Form::label('Slider Text',null,['class' => 'col-form-label']) !!}</h6>
                    {!! Form::text('slider_text_one',null,['class' => 'form-control']) !!}
                  </div>
                  @if (!empty($user['slider_image_two']))
                      {!! Form::hidden('slider_image_two',$user['slider_image_two']) !!}
                    <div class="col-md-6 mb-6">
                      <h6>{!! Form::label(' Slider Image ',null,['class' => 'col-form-label']) !!}{!! Form::file('slider_image_two',null,['class' => 'custom-file-label']) !!}
                        <span>
                                                                                                                <img
                                                                                                                  style="float: inside;"
                                                                                                                  height="60"
                                                                                                                  width="60"
                                                                                                                  src="{{ env('APP_URL').'public/storage/web/'.$user['logo_bottom']}}">
                                                                                                            </span></h6>
                    </div>

                  @else

                    <div class="col-md-6 mb-6">
                      <h6>{!! Form::label('Slider Image',null,['class' => 'col-form-label']) !!}</h6>
                      {!! Form::file('slider_image_two',null,['class' => 'custom-file-label']) !!}
                    </div>
                  @endif


                  <div class="col-md-6 mb-6">
                    <h6>{!! Form::label('Slider Text',null,['class' => 'col-form-label']) !!}</h6>
                    {!! Form::text('slider_text_two',null,['class' => 'form-control']) !!}
                  </div>
                  <div class="col-md-6 mb-6">
                    <h6>{!! Form::label('Contact Phone',null,['class' => 'col-form-label']) !!}</h6>
                    {!! Form::text('phone',null,['class' => 'form-control']) !!}
                  </div>
                  <div class="col-md-6 mb-6">
                    <h6>{!! Form::label('Contact Email',null,['class' => 'col-form-label']) !!}</h6>
                    {!! Form::text('email',null,['class' => 'form-control']) !!}
                  </div>
                  <div class="col-md-6 mb-6">
                    <h6>{!! Form::label('Address',null,['class' => 'col-form-label']) !!}</h6>
                    {!! Form::text('address',null,['class' => 'form-control']) !!}
                  </div>
                  <div class="col-md-6 mb-6">
                    <h6>{!! Form::label('Facebook Page',null,['class' => 'col-form-label']) !!}</h6>
                    {!! Form::text('facebook_page',null,['class' => 'form-control']) !!}
                  </div>
                  <div class="col-md-6 mb-6">
                    <h6>{!! Form::label('Twitter Page',null,['class' => 'col-form-label']) !!}</h6>
                    {!! Form::text('twitter_page',null,['class' => 'form-control']) !!}
                  </div>
                  <div class="col-md-6 mb-6">
                    <h6>{!! Form::label('Instagram Page',null,['class' => 'col-form-label']) !!}</h6>
                    {!! Form::text('instagram_page',null,['class' => 'form-control']) !!}
                  </div>

                  <div class="col-md-6 mb-6">
                    <h6>{!! Form::label('Specials',null,['class' => 'input-group-text']) !!}</h6>
                    {!! Form::textarea('specials',null,['class' => 'form-control']) !!}
                  </div>
                  <div class="col-md-6 mb-6">
                    <h6>{!! Form::label('About Info',null,['class' => 'input-group-text']) !!}</h6>
                    {!! Form::textarea('about_info',null,['class' => 'form-control']) !!}
                  </div>
                  <div class="col-md-6 mb-6">
                    <h6>{!! Form::label('Get In Touch',null,['class' => 'input-group-text']) !!}</h6>
                    {!! Form::textarea('get_in_touch',null,['class' => 'form-control']) !!}
                  </div>
                  <div class="col-md-6 mb-6">
                    <h6>{!! Form::label('Open Hours',null,['class' => 'col-form-label']) !!}</h6>
                    {!! Form::text('open_hours',null,['class' => 'form-control']) !!}
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-12 mb-12">
                  {!! Form::submit($buttonText,['class'=>'btn btn-flat btn-success btn-lg btn-block']) !!}
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