@extends('rcpadmin.layouts.app')

@section('breadcrumbs')
  <div class="breadcrumbs-area clearfix">
    <h4 class="page-title pull-left">Simple Text Keyword</h4>
    <ul class="breadcrumbs pull-left">
      <li><a href="{{ url('rcpadmin/').'/' }}">Home</a></li>
      <li><span>Simple Text Keyword</span></li>
    </ul>
  </div>
@stop
@section('content')

  <!--start container-->
  <div class="main-content">

    <div class="main-content-inner">
      <div class="row">

        <div class="col-lg-6 col-ml-12">
          <div class="row">

            <div class="col-12">
              <div class="card mt-5">
                <div class="card-body">
                  <h4 class="header-title">Simple Text CSV</h4>


                  {{ Form::open(array('url' => 'rcpadmin/simple-keyword-text', 'files' => true),['method'=>'POST']) }}
                  {!! csrf_field() !!}
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" name="file"  class="custom-file-input" id="inputGroupFile04">
                      <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                    </div>

                  </div>

                  {{ Form::submit('Upload!', array('class' => 'btn btn-primary')) }}
                  {{ Form::close() }}
                </div>
              </div>
            </div>
            <!-- Custom file input end -->
          </div>
        </div>
      </div>
    </div>
  </div>

@stop
