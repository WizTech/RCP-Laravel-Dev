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
    <h4 class="page-title pull-left">Stats</h4>
    <ul class="breadcrumbs pull-left">
      <li><a href="{{ url('rcpadmin/').'/' }}">Dashboard</a></li>
      <li><span>Stats / </span></li>
      <li><a href="{{'rcpadmin/users-count'}}">Users Count</a></li>
    </ul>
  </div>
@stop
@section('content')
  <div class="row">
    <div class="col-12 mt-5">
      <div align="left">
           <form action="{{url('rcpadmin/users-count')}}" method="post">
               {{ csrf_field() }}

               <button type="submit" class="btn btn-success btn-lg"> EXPORT LIST</button>
           </form>
       </div>

      <div class="card">
        <div class="card-body">
          <div class="table-responsive datatable-dark">
            <table class="text-center table">
              <thead class="text-capitalize">
              <tr>

                <th>Campus</th>
                <th>Free Users</th>
                <th>Paid Users</th>

              </tr>
              </thead>
              <tbody>
              @if(!empty($leads['leads']))
                @foreach( $leads['leads'] as $lead)
                  <tr>
                    <td>{{$lead->name}} </td>
                    <td>{{$lead->campus_free}} </td>
                    <td>{{$lead->campus_paid}} </td>


                  </tr>
                @endforeach
              @endif
              </tbody>
            </table>
            {{--@if(isset($leads['leads']) && count($leads['leads']) > 0)
              {{$leads['leads']->links()}}
              Showing {{$leads['leads']->firstItem()}} to {{$leads['leads']->lastItem()}}
              of {{$leads['leads']->total()}}
              Entities
            @endif--}}
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
  <script type="text/javascript">
    $(document).ready(function () {
      $('#leadType').on('change', function (e) {
        e.preventDefault();
        this.form.submit();
      });
      $('#campusId').on('change', function (e) {
        e.preventDefault();
        this.form.submit();
      });
    });
  </script>
@stop