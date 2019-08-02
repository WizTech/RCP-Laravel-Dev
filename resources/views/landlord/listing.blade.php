@extends('landlord.layouts.app')
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
    <h4 class="page-title pull-left">{{isset($module) ? 'Deleted':'My'}} Listing</h4>
    <ul class="breadcrumbs pull-left">
      <li><a href="{{ url('landlord/').'/' }}">Dashboard</a></li>
      @if(!isset($module))
      <li><span>My Listing</span></li>
      @else
        <li><span>Deleted Listing</span></li>
      @endif
    </ul>
  </div>
@stop
@section('content')

  <div class="row">
    <div class="col-12 mt-5">
      <div class="card">
        <div class="card-body">
          @if(!isset($module))
          <a href="{{ url('landlord/add-property')}}" class="btn btn-outline-dark header-title">Add
            Listing</a>
          @endif
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
                @foreach($properties as $property)
                  <tr>
                    <td> {{$property['id']}}</td>
                    <td> {{$property['category']['name']}} </td>
                    <td> {{$property['title']}} </td>
                    <td> {{$property['address']}} </td>
                    <td> {{$property['property_expiry_date']}} </td>
                    <td> {{$property['status']}} </td>
                    <td>
                      <ul class="d-flex justify-content-center">
                        @if(isset($module) && $module == 'deleted')
                          <li><a data-listing-id="{{$property['id']}}" href="javascript:void(0)"
                                                       data-method="delete" class="text-danger jquery-postback"><i
                                                      class="ti-light-bulb"></i></a>
                                                </li>
                        @else
                        <li class="mr-3"><a
                            href="{{ url('landlord/property/'.$property['id'])}}"
                            class="text-secondary" target="_blank"><i
                              class="fa fa-edit" title="Detail"></i></a></li>

                        <li class="mr-3"><a
                            href="{{ url('landlord/property/'.$property['id'].'/floorplan')}}"
                            class="text-secondary" target="_blank"><i
                              class="fa fa-university" title="Floorplans"></i></a>
                        </li>
                        <li class="mr-3"><a
                            href="{{ url('landlord/property/'.$property['id'].'/feature')}}"
                            class="text-secondary" target="_blank"><i
                              class="fa fa-folder-open" title="Features"></i></a></li>
                        <li class="mr-3"><a
                            href="{{ url('landlord/property/'.$property['id'].'/images')}}"
                            class="text-secondary" target="_blank"><i
                              class="fa fa-image" title="Photos"></i></a></li>
                        <li><a data-admin-id="{{$property['id']}}" href="javascript:void(0)"
                               data-method="delete" class="text-danger jquery-postback"><i
                              class="ti-trash"></i></a>
                        </li>
                         @endif
                      </ul>
                    </td>
                  </tr>
                @endforeach
              @endif
              </tbody>
            </table>
            <div id="pagination-container">
              @if(isset($properties) && count($properties) > 0)
                {{$properties->links()}}
                Showing {{$properties->firstItem()}} to {{$properties->lastItem()}}
                of {{$properties->total()}} Entities
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
      $.ajax({
        url: '<?php echo url('landlord/property-search-ajax')  ?>',
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


      var id = $this.data('listing-id');

      $.ajax({
        url: '<?php echo url('landlord/active-listing')  ?>',
        data: {id:id},
        type: 'POST',
        success: function (res) {

        }
      })

    })

  </script>
@stop