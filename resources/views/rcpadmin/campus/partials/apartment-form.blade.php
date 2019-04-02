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

                  <div class="col-md-4 mb-4">
                    {!! Form::label('Title Tag',null,['class' => 'col-form-label']) !!}
                    {!! Form::text('meta_title',null,['class' => 'form-control']) !!}
                  </div>
                  <div class="col-md-4 mb-4">
                    {!! Form::label('H1',null,['class' => 'col-form-label']) !!}
                    {!! Form::text('h1',null,['class' => 'form-control']) !!}
                  </div>
                  <div class="col-md-4 mb-4">
                    {!! Form::label('H2',null,['class' => 'col-form-label']) !!}
                    {!! Form::text('h2',null,['class' => 'form-control']) !!}
                  </div>
                  <div class="col-md-6 mb-6">
                    {!! Form::label('Meta Description',null,['class' => 'input-group-text']) !!}
                    {!! Form::textarea('meta_description',null,['class' => 'form-control']) !!}

                  </div>
                  <div class="col-md-6 mb-6">
                    {!! Form::label('Seo Block',null,['class' => 'input-group-text']) !!}
                    {!! Form::textarea('seo_block',null,['class' => 'form-control']) !!}

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