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
          <a href="javascript: void(0);" class="btn btn-outline-dark header-title addNeighborhood">Add Neighborhood</a>
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                 aria-selected="true">Neighborhoods</a>
            </li>


          </ul>
          <div class="tab-content mt-12 " id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

              <div class="form-group" id="NeighborhoodContainer">
                <div class="form-row">
                  @if(count($campus) > 0)
                    @foreach($campus as $neighborhood)

                      <div class="col-md-6 mb-6">
                        {!! Form::hidden('photo[]',$neighborhood['image'],['class' => 'lat']) !!}
                        {!! Form::file('image[]',null,['class' => 'custom-file-label']) !!}
                        @if (!empty($neighborhood['image']))

                          <img style="float: right;" height="60" width="60"

                               src="{{ env('APP_URL').'public/storage/neighborhood/'.$neighborhood['image']}}">

                        @endif
                      </div>
                      <div class="col-md-6 mb-6">
                        {!! Form::label('Image Alt',null,['class' => 'col-form-label']) !!}
                        {!! Form::text('alt[]',$neighborhood['alt'],['class' => 'form-control']) !!}
                      </div>
                      <div class="col-md-6 mb-6">
                        {!! Form::label('Title',null,['class' => 'col-form-label']) !!}
                        {!! Form::text('title[]',$neighborhood['title'],['class' => 'form-control']) !!}
                      </div>
                      <div class="col-md-6 mb-6">
                        {!! Form::label('Description',null,['class' => 'col-form-label']) !!}
                        {!! Form::text('description[]',$neighborhood['description'],['class' => 'form-control']) !!}
                      </div>
                    @endforeach

                  @else
                    <div class="form-row">
                          <div class="col-md-6 mb-6">
                            <input name="image[]" type="file">

                            <img style="float: right;" height="60" width="60"
                                 src="">

                          </div>
                          <div class="col-md-6 mb-6">
                            <label for="Image Alt" class="col-form-label">Image Alt</label>
                            <input class="form-control" name="alt[]" type="text" value="">
                          </div>
                          <div class="col-md-6 mb-6">
                            <label for="Title" class="col-form-label">Title</label>
                            <input class="form-control" name="title[]" type="text" value="">
                          </div>
                          <div class="col-md-6 mb-6">
                            <label for="Description" class="col-form-label">Description</label>
                            <input class="form-control" name="description[]" type="text"
                                   value="">
                          </div>

                        </div>
                  @endif

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

      $('.addNeighborhood').on('click', function () {
        var campus_id = $(this).find('input[name=campus_id]').val();
        console.log(campus_id);
        var url = ' {{ env('ADMIN_URL') }}/campus/addNeighborhood';
        $.ajax({
          url: url,
          type: 'GET',

          success: function (res) {
            if (res !== '') {
              $('#NeighborhoodContainer').append(res);


            }
          }
        });

      });
    })
  </script>
@stop