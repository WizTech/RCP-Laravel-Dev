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
    <h4 class="page-title pull-left">Campus Manager</h4>
    <ul class="breadcrumbs pull-left">
      <li><a href="{{ url('rcpadmin/').'/' }}">Dashboard</a></li>
      <li><span>Campus Manager</span></li>
    </ul>
  </div>
@stop
@section('content')

  <div class="row">
    <div class="col-12 mt-5">
      <div class="card">
        <div class="card-body">

          <a href="{{ url('rcpadmin/campus/create')}}" class="btn btn-outline-dark header-title">Add
            Campus</a>

          <form action="{{ url('rcpadmin/campus-search')}}" method="POST" role="search">
            {{ csrf_field() }}
            <div class="input-group">
              <input type="text" class="form-control" name="q" id="searchBox"
                     placeholder="Search campus"> <span class="input-group-btn">
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
                <th>Name</th>
                <th>Title</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody id="campusData-ajax">
              @if(count($campuses) > 0)
                @foreach($campuses as $campus)
                  <tr>
                    <td> {{$campus['id']}}</td>
                    <td> {{$campus['name']}} </td>
                    <td> {{$campus['title']}} </td>
                    <td> {{$campus['status']}} </td>
                    <td>

                      <ul class="d-flex justify-content-center">
                        <li class="mr-3"><a href="{{ url('rcpadmin/campus/'.$campus['id'])}}"
                                            class="text-secondary" target="_blank"><i
                              class="fa fa-edit" title="Detail"></i></a></li>
                        <li class="mr-3"><a
                            href="{{ url('rcpadmin/campus/'.$campus['id'].'/map')}}"
                            class="text-secondary" title="Map" target="_blank"><i
                              class="fa fa-map"></i></a></li>
                        <li class="mr-3"><a
                            href="{{ url('rcpadmin/campus/'.$campus['id'].'/apartment')}}"
                            class="text-secondary" title="Apartment" target="_blank"><i
                              class="fa fa-building"></i></a></li>
                        <li class="mr-3"><a
                            href="{{ url('rcpadmin/campus/'.$campus['id'].'/renting')}}"
                            class="text-secondary" title="Renting Question" target="_blank"><i
                              class="fa fa-question-circle"></i></a></li>
                        <li class="mr-3"><a
                            href="{{ url('rcpadmin/campus/'.$campus['id'].'/neighborhood')}}"
                            class="text-secondary" title="Neighborhoods" target="_blank"><i
                              class="fa fa-home"></i></a></li>
                        <li class="mr-3"><a
                            href="{{ url('rcpadmin/campus/'.$campus['id'].'/destination')}}"
                            class="text-secondary" title="Destinaion" target="_blank"><i
                              class="fa fa-map-marker"></i></a></li>
                        <li><a data-admin-id="{{$campus['id']}}" href="javascript:void(0)"
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
            <div id="pagination-container">
              @if(isset($campuses) && count($campuses) > 0)
                {{$campuses->links()}}
                Showing {{$campuses->firstItem()}} to {{$campuses->lastItem()}} of {{$campuses->total()}}
                Entities
              @endif
            </div>
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
        url: '<?php echo url('rcpadmin/campus-search-ajax')  ?>',
        data: {q: v},
        type: 'POST',
        success: function (res) {
          $('#campusData-ajax').html(res)
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