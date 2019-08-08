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

<!-- Modal Begin -->
<div id="modals"></div>
<!-- Modal End -->

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

                          <li class="mr-3">
                              <button type="button"
                                      data-campusid="{{$campus['id']}}"
                                      class="btn btn-success btn-xs fa fa-pencil-square-o editCampus" title="Edit Campus">
                              </button>
                          </li>
                        {{--<li class="mr-3"><a href="{{ url('rcpadmin/campus/'.$campus['id'])}}"
                                            class="btn btn-success btn-xs fa fa-edit" target="_blank"></a></li>--}}
                        <li class="mr-3">
                            <a
                            href="{{ url('rcpadmin/campus/'.$campus['id'].'/map')}}"
                            class="btn btn-success btn-xs fa fa-map" title="Map" target="_blank"></a>
                        </li>
                        <li class="mr-3"><a
                            href="{{ url('rcpadmin/campus/'.$campus['id'].'/apartment')}}"
                            class="btn btn-primary btn-xs fa fa-building" title="Apartment" target="_blank"></a>
                        </li>
                        <li class="mr-3"><a
                            href="{{ url('rcpadmin/campus/'.$campus['id'].'/renting')}}"
                            class="btn btn-primary btn-xs fa fa-question-circle" title="Renting Question" target="_blank"></a></li>
                        <li class="mr-3"><a
                            href="{{ url('rcpadmin/campus/'.$campus['id'].'/neighborhood')}}"
                            class="btn btn-success btn-xs fa fa-home" title="Neighborhoods" target="_blank"></a></li>
                        <li class="mr-3"><a
                            href="{{ url('rcpadmin/campus/'.$campus['id'].'/destination')}}"
                            class="btn btn-success btn-xs fa fa-map-marker" title="Destinaion" target="_blank"></a></li>
                        <li><a data-admin-id="{{$campus['id']}}" href="javascript:void(0)" title="Delete"
                               data-method="delete" class="btn btn-danger btn-xs fa fa-trash-o jquery-postback"></a>
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

  <script>
      $('.editCampus').on('click', function () {
          campusId = $(this).data('campusid');
          $.get('{{ URL::to("rcpadmin/campus/edit_campus")}}/' + campusId, function (data) {
              $('#modals').empty().append(data);
              $('#campusModal').modal('show');
          });
      });

      $('#modals').on('submit', '#campusEditForm', function (e) {
          e.preventDefault();
          var formData = $(this).serialize();
          $.ajax({
              url: '{{ URL::to("rcpadmin/campus/update_campus")}}/' + campusId,
              type: 'post',
              data: formData,
          }).done(function (data) {
              $('#modals #errors').empty().append(data);
              location.reload();
          }).fail(function (error) {
              var error = error.responseJSON;

              var validationErrors = error.errors;

              console.log(error);

              if (typeof validationErrors.status !== "undefined") {
                  validationErrors.status.forEach(function (element, index) {
                      $('#modals #errors').append('<li class="alert alert-danger">' + element + ' <button type = "button" class="close" data-dismiss = "alert">x</button></li>');
                  });
              }

              if (typeof validationErrors.name !== "undefined") {
                  validationErrors.name.forEach(function (element, index) {
                      $('#modals #errors').append('<li class="alert alert-danger">' + element + ' <button type = "button" class="close" data-dismiss = "alert">x</button></li>');
                  });
              }

              if (typeof validationErrors.address !== "undefined") {
                  validationErrors.address.forEach(function (element, index) {
                      $('#modals #errors').append('<li class="alert alert-danger">' + element + ' <button type = "button" class="close" data-dismiss = "alert">x</button></li>');
                  });
              }

              if (typeof validationErrors.title !== "undefined") {
                  validationErrors.title.forEach(function (element, index) {
                      $('#modals #errors').append('<li class="alert alert-danger">' + element + ' <button type = "button" class="close" data-dismiss = "alert">x</button></li>');
                  });
              }

              if (typeof validationErrors.h1 !== "undefined") {
                  validationErrors.h1.forEach(function (element, index) {
                      $('#modals #errors').append('<li class="alert alert-danger">' + element + ' <button type = "button" class="close" data-dismiss = "alert">x</button></li>');
                  });
              }

              if (typeof validationErrors.h2 !== "undefined") {
                  validationErrors.h2.forEach(function (element, index) {
                      $('#modals #errors').append('<li class="alert alert-danger">' + element + ' <button type = "button" class="close" data-dismiss = "alert">x</button></li>');
                  });
              }

              if (typeof validationErrors.premium_banner !== "undefined") {
                  validationErrors.premium_banner.forEach(function (element, index) {
                      $('#modals #errors').append('<li class="alert alert-danger">' + element + ' <button type = "button" class="close" data-dismiss = "alert">x</button></li>');
                  });
              }

              if (typeof validationErrors.live !== "undefined") {
                  validationErrors.live.forEach(function (element, index) {
                      $('#modals #errors').append('<li class="alert alert-danger">' + element + ' <button type = "button" class="close" data-dismiss = "alert">x</button></li>');
                  });
              }

              if (typeof validationErrors.rating !== "undefined") {
                  validationErrors.rating.forEach(function (element, index) {
                      $('#modals #errors').append('<li class="alert alert-danger">' + element + ' <button type = "button" class="close" data-dismiss = "alert">x</button></li>');
                  });
              }

              if (typeof validationErrors.meta_title !== "undefined") {
                  validationErrors.meta_title.forEach(function (element, index) {
                      $('#modals #errors').append('<li class="alert alert-danger">' + element + ' <button type = "button" class="close" data-dismiss = "alert">x</button></li>');
                  });
              }
              if (typeof validationErrors.meta_description !== "undefined") {
                  validationErrors.meta_description.forEach(function (element, index) {
                      $('#modals #errors').append('<li class="alert alert-danger">' + element + ' <button type = "button" class="close" data-dismiss = "alert">x</button></li>');
                  });
              }
              if (typeof validationErrors.seo_block !== "undefined") {
                  validationErrors.seo_block.forEach(function (element, index) {
                      $('#modals #errors').append('<li class="alert alert-danger">' + element + ' <button type = "button" class="close" data-dismiss = "alert">x</button></li>');
                  });
              }

          });

      });
  </script>
@stop