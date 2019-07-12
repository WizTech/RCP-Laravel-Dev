@if (isset($errors) && count($errors) > 0)
  <div id="card-alert" class="card red lighten-5">
    <div class="card-content red-text">


      @foreach ($errors->all() as $error)
        <p>{{ $error }}</p>
      @endforeach

    </div>
  </div>
@endif
@if(isset($template['body']) && !empty($template['body']))
  @php $body = $template['body']; @endphp

@else
  @php $body = ''; @endphp

@endif
<div class="form-group">
  {!! Form::label('Name',null,['class' => 'col-form-label']) !!}
  {!! Form::text('name',null,['class' => 'form-control']) !!}
</div>
<div class="form-group">
  {!! Form::label('Subject',null,['class' => 'col-form-label']) !!}
  {!! Form::text('subject',null,['class' => 'form-control']) !!}
</div>
<div class="input-group">
 {{-- <div class="input-group-prepend">
                                                     <span class="input-group-text">With textarea</span>
                                                 </div>--}}
  {!! Form::label('Body',null,['class' => 'input-group-text']) !!}
  {!! Form::textarea('body',$body,['class' => 'form-control']) !!}
</div>
<div class="form-group">
  {!! Form::label('Slug',null,['class' => 'col-form-label']) !!}
  {!! Form::text('slug',null,['class' => 'form-control']) !!}
</div>
<div class="form-group">

  {!! Form::submit($buttonText,['class'=>'btn btn-flat btn-success btn-lg btn-block']) !!}
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