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
                      <div class="form-row">

                        @if(count($features) > 0)
                          @foreach($features as $feature)
                            <div class="col-md-3 mb-2">
                              <div class="custom-control custom-checkbox">

                                {!! Form::checkbox('customCheck'.$feature['id'],'no', $feature['id'],['class' => 'custom-control-input','id' => 'customCheck'.$feature['id']]) !!}
                                {!! Form::label('customCheck'.$feature['id'],$feature['name'],['class' => 'custom-control-label','for' => 'customCheck']) !!}

                              </div>


                            </div>
                          @endforeach
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
    </div>
  </div>
</div>

@section('scripts')
  <script>

  </script>
@stop