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
    <h4 class="page-title pull-left">Campus Insight</h4>
    <ul class="breadcrumbs pull-left">
      <li><a href="{{ url('landlord/').'/' }}">Dashboard</a></li>
      <li><span>Campus Insight</span></li>
    </ul>
  </div>
@stop
@section('content')
  <div class="row">
    <div class="col-12 mt-5">
      <div class="card">
        <div class="card-body">

          <div class="table-responsive datatable-dark">
            <table class="text-center table">
              <thead class="text-capitalize">
              <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Link</th>
                <th>File</th>

              </tr>
              </thead>
              <tbody>
              @if(!empty($campus))
                <?php $x = 1; ?>
                @foreach($campus as $c)
                  <tr>
                    <td> {{ $x }}</td>
                    <td> {{$c['title']}} </td>
                    <td> {{$c['link']}} </td>
                    <td><a target="_blank"
                           href={{ url('storage/uploads/campusinsight/'.$c['pdf_file'])}}><img
                          style="float: right;" height="60" width="60"
                          src="{{ env('APP_URL').'storage/uploads/pdf-logo.png'}}"></a>
                    </td>

                  </tr>
                  <?php $x++; ?>
                @endforeach
              @endif
              </tbody>
            </table>
            @if(isset($campus) && count($campus) > 0)
              {{$campus->links()}}
              Showing {{$campus->firstItem()}} to {{$campus->lastItem()}} of {{$campus->total()}} Entities
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