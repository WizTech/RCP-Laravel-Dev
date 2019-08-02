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
          <a href="javascript: void(0);" class="btn btn-outline-dark header-title addDestination">Add Destination</a>
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                 aria-selected="true">Destination</a>
            </li>


          </ul>
          <div class="tab-content mt-12 " id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

              <div class="form-group" id="destinationsContainer">
                @if(count($campus) > 0)
                  @foreach($campus as $destination)
                    <div class="form-row">
                      <div class="col-md-6 mb-6">
                        {!! Form::label('Name',null,['class' => 'col-form-label']) !!}
                        {!! Form::text('name[]',$destination['name'],['class' => 'form-control']) !!}

                        {!! Form::hidden('lat[]',$destination['lat'],['class' => 'lat']) !!}
                        {!! Form::hidden('lng[]',$destination['lng'],['class' => 'lng']) !!}
                      </div>
                      <div class="col-md-6 mb-6">
                        {!! Form::label('Address',null,['class' => 'col-form-label']) !!}
                        {!! Form::text('address[]',$destination['address'],['class' => 'form-control address']) !!}
                      </div>


                    </div>
                  @endforeach
                @else
                  <div class="form-row">
                        <div class="col-md-6 mb-6">
                          <label for="Name" class="col-form-label">Name</label>
                          <input class="form-control" name="name[]" type="text" value="">
                          <input class="lat" name="lat[]" type="hidden" value="">
                          <input class="lng" name="lng[]" type="hidden" value="">
                        </div>
                        <div class="col-md-6 mb-6">
                          <label for="Address" class="col-form-label">Address</label>
                          <input class="form-control address" name="address[]" type="text"
                                 value="">
                        </div>
                      </div>
                @endif
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
  <script src="https://cdn.apple-mapkit.com/mk/5.x.x/mapkit.js"></script>
  <script src="{{ env('ASSETS_PATH') }}tinymce/tinymce.min.js"></script>
  <script>
    mapkit.init({
      authorizationCallback: function (done) {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "https://www.rentcollegepads.com/ajax_req/jwt-authorize.php");
        xhr.addEventListener("load", function () {
          done(this.responseText);
        });
        xhr.send();
      }
    });
    function FullAddressValidatorMapkit(value, element, paras) {

      var CurrentAddress = value;
      if (typeof value === 'undefined' || value.length == 0) {
        return false;
      }
      CurrentAddress = CurrentAddress.replace(" S ", " South ");
      CurrentAddress = CurrentAddress.replace(" s ", " South ");
      CurrentAddress = CurrentAddress.replace(" N ", " North ");
      CurrentAddress = CurrentAddress.replace(" n ", " North ");
      CurrentAddress = CurrentAddress.replace(" ave ", " Avenue ");
      CurrentAddress = CurrentAddress.replace(" Ave ", " Avenue ");
      CurrentAddress = CurrentAddress.replace(/\n/g, "");
      var geocoderMapkit = new mapkit.Geocoder({
        language: "en-GB",
        getsUserLocation: false
      });
      geocoderMapkit.lookup(CurrentAddress, function (error, data) {
        var getData = data.results[0];
        if (typeof getData !== 'undefined') {
          if (error !== 'null' && getData['countryCode'] === "US") {

            $(element).closest('.lat').val(getData['coordinate']['latitude']);
            $(element).closest('.lat').val(getData['coordinate']['longitude']);
            $(element).val(getData['formattedAddress']);
            //$(element).parents('div.span6').find('span.addr-error').html('');
          }

        }

      });
      return true;
    }
    $(document).ready(function () {
      $('.address').on('blur', function () {
        var value = $(this).val();
        var obj = $(this);
        if (value != '') {
          FullAddressValidatorMapkit(value, obj);
        }
      })

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


      $('.addDestination').on('click', function () {
        var campus_id = $(this).find('input[name=campus_id]').val();
        console.log(campus_id);
        var url = ' {{ env('ADMIN_URL') }}/campus/addDestination';
        $.ajax({
          url: url,
          type: 'GET',

          success: function (res) {
            if (res !== '') {
              $('#destinationsContainer').append(res);


            }
          }
        });

      });

    })
  </script>
@stop