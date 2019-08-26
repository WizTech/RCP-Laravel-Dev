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
        <h4 class="page-title pull-left">Property Manager</h4>
        <ul class="breadcrumbs pull-left">
            <li><a href="{{ url('rcpadmin/').'/' }}">Dashboard</a></li>
            <li><span>Property Manager</span></li>
        </ul>
    </div>

@stop
@section('content')

    <div class="row mt-3">
        <div class="col-12 border">
            <div class="breadcrumbs-area clearfix row bg-green">
                <h4 class="page-title px-3 py-2 text-white">{{ucwords($landlord['name'])}}'s Properties </h4>
            </div>
            <div class="card mt-3">
                <div class="card-body p-0">
                    <a href="{{ url('rcpadmin/property/create')}}" class="btn btn-outline-dark header-title">Add
                        Property</a>
                    <form action="{{ url('rcpadmin/property-search')}}" method="POST" role="search">
                        {{ csrf_field() }}
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="q" id="searchBox"
                                   placeholder="Search property"> <span class="input-group-btn ml-3">
                                                                    <button type="submit" class="btn btn-default">
                                                                        Submit
                                                                    </button>
                                                                </span>
                        </div>
                    </form>
                    <div class="table-responsive datatable-dark">
                        <table class="text-center table">
                            <thead class="text-capitalize">
                            <tr>
                                <th>ID</th>
                                <th>Category</th>
                                <th>Title</th>
                                <th>Address</th>
                                <th>Expiry</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="propertyData-ajax">
                            @if(count($properties) > 0)
                                <?php $x = 1; ?>
                                @foreach($properties as $property)
                                    <tr>
                                        <td> {{$x}}</td>
                                        <td> {{$property['category']['name']}} </td>
                                        <td> {{$property['title']}} </td>
                                        <td> {{$property['address']}} </td>
                                        <td> {{date("m/d/Y", strtotime($property['property_expiry_date']))}} </td>
                                        <td> {{$property['status']}} </td>
                                        <td>
                                            <ul class="d-flex justify-content-center">
                                                <li class="mr-3"><a
                                                            href="{{ url('rcpadmin/property/'.$property['id'])}}"
                                                            class="text-secondary" target="_blank"><i
                                                                class="fa fa-edit" title="Detail"></i></a></li>

                                                <li class="mr-3"><a
                                                            href="{{ url('rcpadmin/property/'.$property['id'].'/floorplan')}}"
                                                            class="text-secondary" target="_blank"><i
                                                                class="fa fa-university" title="Floorplans"></i></a>
                                                </li>
                                                <li class="mr-3"><a
                                                            href="{{ url('rcpadmin/property/'.$property['id'].'/feature')}}"
                                                            class="text-secondary" target="_blank"><i
                                                                class="fa fa-folder-open" title="Features"></i></a></li>
                                                <li class="mr-3"><a
                                                            href="{{ url('rcpadmin/property/'.$property['id'].'/images')}}"
                                                            class="text-secondary" target="_blank"><i
                                                                class="fa fa-image" title="Photos"></i></a></li>
                                                <li><a data-admin-id="{{$property['id']}}" href="javascript:void(0)"
                                                       data-method="delete" class="text-danger jquery-postback"><i
                                                                class="ti-trash"></i></a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <?php $x++; ?>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                        {{--<div id="pagination-container">
                            @if(isset($properties) && count($properties) > 0)
                                {{$properties->links()}}
                                Showing {{$properties->firstItem()}} to {{$properties->lastItem()}}
                                of {{$properties->total()}} Entities
                            @endif
                        </div>--}}
                    </div>
                </div>
            </div>
        </div>

    </div>

@stop

@section('scripts')
    <!-- data-tables -->
    <!-- data-tables -->
    <script src="{{ env('THEME_ASSETS_NEW') }}assets/cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="{{ env('THEME_ASSETS_NEW') }}assets/cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="{{ env('THEME_ASSETS_NEW') }}assets/cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script
            src="{{ env('THEME_ASSETS_NEW') }}assets/cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script
            src="{{ env('THEME_ASSETS_NEW') }}assets/cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
    <script src="{{ env('ASSETS_PATH') }}js/ajax_viewer.js"></script>
    <script>
        $('#searchBox').typeDone(function () {

            var v = $('#searchBox').val();

            if (v == '' || v.length <= 2) {
                return false;
            }

            console.log(v)

            $.ajax({
                url: '<?php echo url('rcpadmin/property-search-ajax')  ?>',
                data: {q: v},
                type: 'POST',
                success: function (res) {
                    $('#propertyData-ajax').html(res)
                    $('#pagination-container').html('')
                }
            });

        }, 900);
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
@stop