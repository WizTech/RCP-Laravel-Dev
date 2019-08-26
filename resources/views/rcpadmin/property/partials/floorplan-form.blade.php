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
                    <a href="javascript: void(0);" class="btn btn-outline-dark header-title addDestination">Add
                        Floorplan</a>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                               aria-controls="home"
                               aria-selected="true">Floorplans</a>
                        </li>
                    </ul>
                    <div class="tab-content mt-12 " id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="form-group" id="destinationsContainer">
                                @if(count($floorplans) > 0)
                                    @foreach($floorplans as $floorplan)
                                        <div class="form-row">
                                            <div class="col-md-2 mb-4">
                                                {!! Form::label('Title',null,['class' => 'col-form-label']) !!}
                                                {!! Form::text('title[]',$floorplan['title'],['class' => 'form-control']) !!}
                                            </div>
                                            <div class="col-md-2 mb-4">
                                                {!! Form::label('Bedroom',null,['class' => 'col-form-label']) !!}
                                                {!! Form::text('bed[]',$floorplan['bed'],['class' => 'form-control address']) !!}
                                            </div>
                                            <div class="col-md-2 mb-4">
                                                {!! Form::label('Bathroom',null,['class' => 'col-form-label']) !!}
                                                {!! Form::text('bath[]',$floorplan['bath'],['class' => 'form-control address']) !!}
                                            </div>
                                            <div class="col-md-2 mb-4">
                                                {!! Form::label('Rent',null,['class' => 'col-form-label']) !!}
                                                {!! Form::text('price[]',$floorplan['price'],['class' => 'form-control address']) !!}
                                            </div>
                                            <div class="col-md-2 mb-4">
                                                {!! Form::label('Sq Footage',null,['class' => 'col-form-label']) !!}
                                                {!! Form::text('sq_footage[]',$floorplan['sq_footage'],['class' => 'form-control address']) !!}
                                            </div>
                                            <div class="col-md-2 mb-4">
                                                {!! Form::label('Date Available',null,['class' => 'col-form-label']) !!}
                                                {{--{!! Form::text('available_date[]',$floorplan['available_date'],['class' => 'form-control address']) !!}--}}
                                                {{  Form::text('available_date[]', $floorplan['available_date'], ['class' => 'form-control, datePicker', 'id'=>'datetimepicker']) }}
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="form-row">
                                        <div class="col-md-2 mb-2">
                                            <label for="Title" class="col-form-label">Title</label>
                                            <input class="form-control" name="title[]" type="text" value="">

                                        </div>
                                        <div class="col-md-2 mb-2">
                                            <label for="Bed" class="col-form-label">Bedroom</label>
                                            <input class="form-control bed" name="bed[]" type="text"
                                                   value="">
                                        </div>
                                        <div class="col-md-2 mb-2">
                                            <label for="Bathroom" class="col-form-label">Bathroom</label>
                                            <input class="form-control bath" name="bath[]" type="text"
                                                   value="">
                                        </div>
                                        <div class="col-md-2 mb-2">
                                            <label for="Rent" class="col-form-label">Rent</label>
                                            <input class="form-control rent" name="price[]" type="text"
                                                   value="">
                                        </div>
                                        <div class="col-md-2 mb-2">
                                            <label for="Sq Footage" class="col-form-label">Square Footage</label>
                                            <input class="form-control sq_footage" name="sq_footage[]" type="text"
                                                   value="">
                                        </div>
                                        <div class="col-md-2 mb-2">
                                            <label for="Available Date" class="col-form-label">Available Date</label>
                                            <input class="form-control datePicker" name="available_date[]" type="text" id="datetimepicker"
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
    <script>
        $(document).ready(function () {
            $('.addDestination').on('click', function () {
                var campus_id = $(this).find('input[name=campus_id]').val();
                console.log(campus_id);
                var url = '{{ env('ADMIN_URL') }}/property/addFloorplan';
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
    <script>
        $('#datetimepicker').datetimepicker({
            format: 'yyyy-mm-dd'
        });
    </script>
@stop