@if (isset($errors) && count($errors) > 0)
  <div id="card-alert" class="card red lighten-5">
    <div class="card-content red-text">


      @foreach ($errors->all() as $error)
        <p>{{ $error }}</p>
      @endforeach

    </div>
  </div>
@endif
{{--<style>
  h2.header-title {
    padding: 0px 0px 10px 0px;
    margin: 0px 0px 10px 0px;
    font-size: 18px;
    color: #7d7d7d;
    text-transform: uppercase;
    border-bottom: 1px dotted #d1d0d0;
    font-weight: normal;
  }
</style>--}}

@php
  $listingId = $propertyData['id']
@endphp
<div class="col-lg-12 mt-12">
  <div class="card">
    <div class="card-body">
      <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="pills-information-tab" data-toggle="pill" href="#pills-information" role="tab"
             aria-controls="pills-information" aria-selected="true">Information</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="pills-amenities-tab" data-toggle="pill" href="#pills-amenities" role="tab"
             aria-controls="pills-amenities" aria-selected="false">Amenities</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="pills-units-tab" data-toggle="pill" href="#pills-units" role="tab"
             aria-controls="pills-units" aria-selected="false">Units</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="pills-photos-tab" data-toggle="pill" href="#pills-photos" role="tab"
             aria-controls="pills-photos" aria-selected="false">Photos</a>
        </li>
      </ul>
      <div class="tab-content" id="pills-tabContent">

        @if(!isset($addListing))
          <div class="tab-pane fade show active" id="pills-information" role="tabpanel"
               aria-labelledby="pills-information-tab">
            <h2 class="header-title">Property Information:</h2>
            {!! Form::model($property,['method'=>'POST', 'files' => true,'route' => array('listing.update', $property['id']),'class' => 'col s12']) !!}
            {!! Form::hidden('id') !!}
            <div class="form-group">

              <div class="form-row">


                <div class="col-md-4 mb-2">
                  {!! Form::label('Campus Name',null,['class' => 'col-form-label']) !!}

                </div>
                <div class="col-md-6 mb-4">
                  {!! Form::select('campus_id',$campusSelect,null,['class' => 'custom-select']) !!}
                </div>

                <div class="col-md-4 mb-4">
                  {!! Form::label('Property Type',null,['class' => 'col-form-label']) !!}

                </div>
                <div class="col-md-6 mb-4">
                  {!! Form::select('category_id',$categorySelect,null,['class' => 'custom-select']) !!}
                </div>


                <div class="col-md-4 mb-4">
                  {!! Form::label('Street Address',null,['class' => 'col-form-label']) !!}

                </div>
                <div class="col-md-6 mb-4">
                  {!! Form::text('address',null,['class' => 'form-control']) !!}
                </div>

                <div class="col-md-4 mb-4">
                  {!! Form::label('Number of Units',null,['class' => 'col-form-label']) !!}

                </div>
                <div class="col-md-6 mb-4">
                  {!! Form::text('units_number',null,['class' => 'form-control']) !!}
                </div>


                <div class="col-md-4 mb-2">
                  {!! Form::label('Apartment Name',null,['class' => 'col-form-label']) !!}

                </div>
                <div class="col-md-6 mb-4">
                  {!! Form::text('title',null,['class' => 'form-control']) !!}
                </div>

                <div class="col-md-4 mb-2">
                  {!! Form::label('Description',null,['class' => 'col-form-label']) !!}

                </div>
                <div class="col-md-6 mb-4">
                  {!! Form::textarea('description',null,['class' => 'form-control']) !!}
                </div>

                <div class="col-md-4 mb-2">
                  {!! Form::label('Special',null,['class' => 'col-form-label']) !!}

                </div>
                <div class="col-md-6 mb-4">
                  {!! Form::textarea('special',null,['class' => 'form-control']) !!}
                </div>


              </div>


            </div>
            <div class="form-group">
              <div class="col-md-12 mb-12">
                {!! Form::submit($buttonText,['class'=>'btn btn-flat btn-success btn-lg btn-block']) !!}
              </div>
            </div>
            {!! Form::close() !!}
          </div>
          <div class="tab-pane fade" id="pills-amenities" role="tabpanel" aria-labelledby="pills-amenities-tab">
            {!! Form::model($features,['method'=>'POST', 'files' => true,'route' => array('feature.update', $propertyData['id']),'class' => 'col s12']) !!}
            {!! Form::hidden('id') !!}
            {!! Form::hidden('property_id',$propertyData['id']) !!}
            @include('landlord.property.partials.feature-form',['buttonText'=>'Update'])
            {!! Form::close() !!}
          </div>
          <div class="tab-pane fade" id="pills-units" role="tabpanel" aria-labelledby="pills-units-tab">
            {!! Form::model($floorplans,['method'=>'POST', 'files' => true,'route' => array('floorplan.update', $propertyData['id']),'class' => 'col s12']) !!}
            {!! Form::hidden('id') !!}
            {!! Form::hidden('property_id',$propertyData['id']) !!}
            @include('landlord.property.partials.floorplan-form',['buttonText'=>'Update'])
            {!! Form::close() !!}
          </div>
          <div class="tab-pane fade" id="pills-photos" role="tabpanel" aria-labelledby="pills-photos-tab">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                   aria-controls="profile"
                   aria-selected="false">View Images</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="upload-tab" data-toggle="tab" href="#upload" role="tab"
                   aria-controls="upload"
                   aria-selected="true">Upload Images</a>
              </li>
            </ul>
            <div class="tab-content mt-12 " id="myTabContent">
              <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                <div class="table-responsive-sm">
                  <table class="table">
                    <thead>
                    <tr>
                      <th scope="col">Image</th>
                      <th scope="col">Action</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($images as $photo)
                      <tr>
                        <td>
                          <img
                            src="{{env('APP_URL')}}public/storage/uploads/property_images/thumbs/{{ $photo['image'] }}">
                        </td>
                        <td>
                          <ul class="d-flex justify-content-center">
                            <li><a data-admin-id="{{$photo['id']}}"
                                   href="{{url('landlord/property/'.$photo['id'].'/delete')}}"
                                   data-method="delete" class="text-danger jquery-postback"><i
                                  class="ti-trash"></i></a>
                            </li>
                          </ul>
                        </td>
                      </tr>

                    @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="tab-pane fade" id="upload" role="tabpanel" aria-labelledby="upload-tab">
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-sm-10 offset-sm-1">
                      <form method="post"
                            action="{{ url('/landlord/property/'.$listingId.'/images-save') }}"
                            enctype="multipart/form-data" class="dropzone" id="my-dropzone">
                        {{ csrf_field() }}
                        <div class="dz-message">
                          <div class="col-xs-8">
                            <div class="message">
                              <p>Drop files here or Click to Upload</p>
                            </div>
                          </div>
                        </div>
                        <div class="fallback">
                          <input type="file" name="file" multiple>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>

            </div>

            {{--Dropzone Preview Template--}}
            <div id="preview" style="display: none;">

              <div class="dz-preview dz-file-preview">
                <div class="dz-image"><img data-dz-thumbnail/></div>

                <div class="dz-details">
                  <div class="dz-size"><span data-dz-size></span></div>
                  <div class="dz-filename"><span data-dz-name></span></div>
                </div>
                <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
                <div class="dz-error-message"><span data-dz-errormessage></span></div>


                <div class="dz-success-mark">

                  <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg"
                       xmlns:xlink="http://www.w3.org/1999/xlink"
                       xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
                    <!-- Generator: Sketch 3.2.1 (9971) - http://www.bohemiancoding.com/sketch -->
                    <title>Check</title>
                    <desc>Created with Sketch.</desc>
                    <defs></defs>
                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                      <path
                        d="M23.5,31.8431458 L17.5852419,25.9283877 C16.0248253,24.3679711 13.4910294,24.366835 11.9289322,25.9289322 C10.3700136,27.4878508 10.3665912,30.0234455 11.9283877,31.5852419 L20.4147581,40.0716123 C20.5133999,40.1702541 20.6159315,40.2626649 20.7218615,40.3488435 C22.2835669,41.8725651 24.794234,41.8626202 26.3461564,40.3106978 L43.3106978,23.3461564 C44.8771021,21.7797521 44.8758057,19.2483887 43.3137085,17.6862915 C41.7547899,16.1273729 39.2176035,16.1255422 37.6538436,17.6893022 L23.5,31.8431458 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z"
                        id="Oval-2" stroke-opacity="0.198794158" stroke="#747474" fill-opacity="0.816519475"
                        fill="#FFFFFF" sketch:type="MSShapeGroup"></path>
                    </g>
                  </svg>

                </div>
                <div class="dz-error-mark">

                  <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg"
                       xmlns:xlink="http://www.w3.org/1999/xlink"
                       xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
                    <!-- Generator: Sketch 3.2.1 (9971) - http://www.bohemiancoding.com/sketch -->
                    <title>error</title>
                    <desc>Created with Sketch.</desc>
                    <defs></defs>
                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                      <g id="Check-+-Oval-2" sketch:type="MSLayerGroup" stroke="#747474" stroke-opacity="0.198794158"
                         fill="#FFFFFF" fill-opacity="0.816519475">
                        <path
                          d="M32.6568542,29 L38.3106978,23.3461564 C39.8771021,21.7797521 39.8758057,19.2483887 38.3137085,17.6862915 C36.7547899,16.1273729 34.2176035,16.1255422 32.6538436,17.6893022 L27,23.3431458 L21.3461564,17.6893022 C19.7823965,16.1255422 17.2452101,16.1273729 15.6862915,17.6862915 C14.1241943,19.2483887 14.1228979,21.7797521 15.6893022,23.3461564 L21.3431458,29 L15.6893022,34.6538436 C14.1228979,36.2202479 14.1241943,38.7516113 15.6862915,40.3137085 C17.2452101,41.8726271 19.7823965,41.8744578 21.3461564,40.3106978 L27,34.6568542 L32.6538436,40.3106978 C34.2176035,41.8744578 36.7547899,41.8726271 38.3137085,40.3137085 C39.8758057,38.7516113 39.8771021,36.2202479 38.3106978,34.6538436 L32.6568542,29 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z"
                          id="Oval-2" sketch:type="MSShapeGroup"></path>
                      </g>
                    </g>
                  </svg>
                </div>
              </div>
            </div>
            {{--End of Dropzone Preview Template--}}
          </div>
        @else
          <div class="tab-pane fade show active" id="pills-information" role="tabpanel"
               aria-labelledby="pills-information-tab">
            <div class="tab-pane fade show active" id="pills-information" role="tabpanel"
                 aria-labelledby="pills-information-tab">
              <h2 class="header-title">Property Information:</h2>

              {!! Form::open(['route' => array('listing.store'),'class' => 'col s12']) !!}
              {!! Form::hidden('id') !!}
              <div class="form-group">

                <div class="form-row">


                  <div class="col-md-4 mb-2">
                    {!! Form::label('Campus Name',null,['class' => 'col-form-label']) !!}

                  </div>
                  <div class="col-md-6 mb-4">
                    {!! Form::select('campus_id',$campusSelect,null,['class' => 'custom-select']) !!}
                  </div>

                  <div class="col-md-4 mb-4">
                    {!! Form::label('Property Type',null,['class' => 'col-form-label']) !!}

                  </div>
                  <div class="col-md-6 mb-4">
                    {!! Form::select('category_id',$categorySelect,null,['class' => 'custom-select']) !!}
                  </div>


                  <div class="col-md-4 mb-4">
                    {!! Form::label('Street Address',null,['class' => 'col-form-label']) !!}

                  </div>
                  <div class="col-md-6 mb-4">
                    {!! Form::text('address',null,['class' => 'form-control']) !!}
                  </div>

                  <div class="col-md-4 mb-4">
                    {!! Form::label('Number of Units',null,['class' => 'col-form-label']) !!}

                  </div>
                  <div class="col-md-6 mb-4">
                    {!! Form::text('units_number',null,['class' => 'form-control']) !!}
                  </div>


                  <div class="col-md-4 mb-2">
                    {!! Form::label('Apartment Name',null,['class' => 'col-form-label']) !!}

                  </div>
                  <div class="col-md-6 mb-4">
                    {!! Form::text('title',null,['class' => 'form-control']) !!}
                  </div>

                  <div class="col-md-4 mb-2">
                    {!! Form::label('Description',null,['class' => 'col-form-label']) !!}

                  </div>
                  <div class="col-md-6 mb-4">
                    {!! Form::textarea('description',null,['class' => 'form-control']) !!}
                  </div>

                  <div class="col-md-4 mb-2">
                    {!! Form::label('Special',null,['class' => 'col-form-label']) !!}

                  </div>
                  <div class="col-md-6 mb-4">
                    {!! Form::textarea('special',null,['class' => 'form-control']) !!}
                  </div>


                </div>


              </div>
              <div class="form-group">
                <div class="col-md-12 mb-12">
                  {!! Form::submit($buttonText,['class'=>'btn btn-flat btn-success btn-lg btn-block']) !!}
                </div>
              </div>
              {!! Form::close() !!}
            </div>
          </div>
        @endif
      </div>
    </div>
  </div>
</div>
