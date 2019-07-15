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
        <h4 class="page-title pull-left">Category Manager</h4>
        <ul class="breadcrumbs pull-left">
            <li><a href="{{ url('rcpadmin/').'/' }}">Dashboard</a></li>
            <li><span>Category Manager</span></li>
        </ul>
    </div>
@stop
@section('content')

<<<<<<< HEAD
    <div class="row">

        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">

                    <a href="{{ url('rcpadmin/category/create')}}" class="btn btn-outline-dark header-title">Add
                        Category</a>
                    <div class="table-responsive datatable-dark">
                        <table class="text-center table">
                            <thead class="text-capitalize">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>

                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($categories) > 0)
                                @foreach($categories as $category)
                                    <tr>
                                        <td> {{$category['id']}}</td>
                                        <td> {{$category['name']}} </td>

                                        <td> {{$category['status']}} </td>
                                        <td>
                                            <ul class="d-flex justify-content-center">
                                                <li class="mr-3"><a
                                                            href="{{ url('rcpadmin/category/'.$category['id'])}}"
                                                            class="text-secondary"><i
                                                                class="fa fa-edit"></i></a></li>
                                                <li><a data-admin-id="{{$category['id']}}"
                                                       href="{{url('rcpadmin/category/'.$category['id'])}}"
                                                       data-method="delete" class="text-danger jquery-postback"><i
                                                                class="ti-trash"></i></a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                        @if(isset($categories) && count($categories) > 0)
                            {{$categories->links()}}
                            Showing {{$categories->firstItem()}} to {{$categories->lastItem()}}
                            of {{$categories->total()}} Entities
                        @endif
                    </div>
                </div>
            </div>
=======
  <div class="row">

    <div class="col-12 mt-5">
      <div class="card">
        <div class="card-body">

          <a href="{{ url('rcpadmin/category/create')}}" class="btn btn-outline-dark header-title">Add
            Category</a>
          <div class="table-responsive datatable-dark">
            <table class="text-center table">
              <thead class="text-capitalize">
              <tr>
                <th>ID</th>
                <th>Name</th>

                <th>Status</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
              @if(count($categories) > 0)
                @foreach($categories as $category)
                  <tr>
                    <td> {{$category['id']}}</td>
                    <td> {{$category['name']}} </td>

                    <td> {{$category['status']}} </td>
                    <td>
                      <ul class="d-flex justify-content-center">
                        <li class="mr-3"><a
                            href="{{ url('rcpadmin/category/'.$category['id'])}}"
                            class="text-secondary"><i
                              class="fa fa-edit"></i></a></li>
                        <li>
                          <form method="POST" action="category/{{$category['id']}}">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <div class="form-group">
                              <input type="submit" class="btn btn-danger btn-xs delete"
                                     value="Delete">
                            </div>
                          </form>
                          </a>
                        </li>
                      </ul>
                    </td>
                  </tr>
                @endforeach
              @endif
              </tbody>
            </table>
            @if(isset($categories) && count($categories) > 0)
              {{$categories->links()}}
              Showing {{$categories->firstItem()}} to {{$categories->lastItem()}}
              of {{$categories->total()}} Entities
            @endif
          </div>
>>>>>>> master
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
@stop