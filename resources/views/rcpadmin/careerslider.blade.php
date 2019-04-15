@extends('rcpadmin.layouts.app')
@section('styles')
    <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css"
          href="{{ env('THEME_ASSETS_NEW') }}assets/cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css"
          href="{{ env('THEME_ASSETS_NEW') }}assets/cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css"
          href="{{ env('THEME_ASSETS_NEW') }}assets/cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
          href="{{ env('THEME_ASSETS_NEW') }}assets/cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
    <!-- style css -->
@stop
@section('breadcrumbs')
    <div class="breadcrumbs-area clearfix">
        <h4 class="page-title pull-left">Career Slider</h4>
        <ul class="breadcrumbs pull-left">
            <li><a href="{{ url('rcpadmin/').'/' }}">Dashboard</a></li>
            <li><span> Content Manager / Career Slider</span></li>
        </ul>
    </div>
@stop
@section('content')
    <div class="row">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <a href="{{ url('rcpadmin/careerslider/create')}}" class="btn btn-outline-dark header-title">Add
                        Career Slider</a>
                    <div class="table-responsive datatable-dark">
                        <table class="text-center table">
                            <thead class="text-capitalize">
                            <tr>
                                <th>ID</th>
                                <th>Slider Type</th>
                                <th>Slider Image</th>
                                <th>1st Heading</th>
                                <th>2nd Heading</th>
                                <th>Time Duration</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($career_sliders))
                                <?php $x = 1; ?>
                                @foreach($career_sliders as $career_slider)
                                    <tr>
                                        <td> {{ $x }}</td>
                                        <td> {{$career_slider['slider_type']}} </td>
                                        <td><img style="float: right;" height="60" width="60"
                                                 src="{{ env('APP_URL').'storage/uploads/careerSlider/'.$career_slider['slider_image']}}">
                                        </td>
                                        <td> {{$career_slider['slider_heading_one']}}</td>
                                        <td> {{$career_slider['slider_heading_two']}}</td>
                                        <td> {{$career_slider['slider_minute']}}</td>
                                        <td> {{$career_slider['status']}}</td>
                                        <td>
                                            <ul class="d-flex justify-content-center">
                                                <li class="mr-3"><a
                                                            href="{{ url('rcpadmin/careerslider/'.$career_slider['id'])}}"
                                                            class="text-secondary"><i
                                                                class="fa fa-edit"></i></a></li>
                                                <form method="POST" action="careerslider/{{$career_slider['id']}}">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <div class="form-group">
                                                        <input type="submit" class="btn btn-danger btn-xs delete"
                                                               value="Delete">
                                                    </div>
                                                </form>
                                            </ul>
                                        </td>
                                    </tr>
                                    <?php $x++; ?>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                        @if(count($career_sliders) > 0)
                            {{$career_sliders->links()}}
                            Showing {{$career_sliders->firstItem()}} to {{$career_sliders->lastItem()}} of {{$career_sliders->total()}} Entities
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <!-- data-tables -->
    <script src="{{ env('THEME_ASSETS_NEW') }}assets/cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="{{ env('THEME_ASSETS_NEW') }}assets/cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="{{ env('THEME_ASSETS_NEW') }}assets/cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script
            src="{{ env('THEME_ASSETS_NEW') }}assets/cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script
            src="{{ env('THEME_ASSETS_NEW') }}assets/cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).on('click', 'a.jquery-postback', function (e) {
            e.preventDefault(); // does not go through with the link.

            if (!confirm('Are you sure?')) {
                return false;
            }

            var $this = $(this);


            var id = $this.data('admin-id');

            $.ajax({

                type: "DELETE",

                url: $this.data('href'),

                data: {"id": id, "_token": "{{ csrf_token() }}"},

                success: function (result) {

                    window.location.reload()
                    //  console.log(result)

                }
            });

        })

    </script>
    <script>
        $('.delete').click(function () {
            return confirm("Are you sure you want to delete?");
        })
    </script>
@stop