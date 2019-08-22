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
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                 aria-selected="true">Features</a>
            </li>


          </ul>
          <div class="tab-content mt-12 " id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
              <div class="col-12 mt-5">
                <div class="card">
                  <div class="card-body">
                    <div class="form-group">


                      @if(count($features) > 0)

                        @foreach ($features as $featureType => $featureData)

                          <h4 class="header-title"
                              style="text-transform: uppercase">{{$featureData[0]['type']['name']}}</h4>
                          @foreach ($featureData as $feature)
                            <div class="form-row">
                              <div class="col-md-3 mb-2">
                                <div class="custom-control custom-checkbox">
                                  <input type="checkbox" name="feature_id[]" {{(in_array($feature['id'], $property_features)) ? 'checked':''}}  class="custom-control-input" value="{{$feature['id']}}" id="customCheck{{$feature['id']}}">
{{--                                  {!! Form::checkbox('customCheck'.$feature['id'],null, $feature['id'],['class' => 'custom-control-input','id' => 'customCheck'.$feature['id'],'checked'=>false]) !!}--}}
                                  {!! Form::label('customCheck'.$feature['id'],$feature['name'],['class' => 'custom-control-label','for' => 'customCheck']) !!}

                                </div>


                              </div>
                            </div>
                          @endforeach
                        @endforeach
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
    </div>
  </div>
</div>

@section('scripts')
  <script>

  </script>
@stop