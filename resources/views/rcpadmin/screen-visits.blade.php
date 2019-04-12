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
        <h4 class="page-title pull-left">Application Screen Visits</h4>
        <ul class="breadcrumbs pull-left">
            <li><a href="{{ url('rcpadmin/').'/' }}">Dashboard</a></li>
            <li><span>Application Stats / Screen Visits</span></li>
        </ul>
    </div>
@stop
@section('content')
    <div class="row">
        <div class="col-12 mt-5">
            <div align="center">
                <form action="{{url('rcpadmin/screen-export')}}" method="get">
                Date From <input type="text" name="date_from" value="<?= date("Y-m-d", strtotime("-1 month")) ?>" class="filter-box datePicker" id="dateFrom">
                To <input type="text" name="date_to" value="<?= date("Y-m-d") ?>" class="filter-box datePicker" id="dateTo">
                <select class="filter-box" id="pageType" name="page_type">
                    <option value="All">All Pages</option>
                    @if(!empty($screenVisits))
                        @foreach($screenVisits as $sv)
                            <?php $page = str_replace('-', ' ', $sv->page_type);
                                    $page_type  = str_replace('_', ' ', $page);
                            ?>
                                <option value="{{ $sv->page_type}}">{{$page_type}}</option>
                        @endforeach
                    @endif
                </select>
                <button type="submit" class="btn btn-success">Export List</button>
                </form>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="data-tables datatable-dark">
                        <table id="dataTable3" class="text-center">
                            <thead class="text-capitalize">
                            <tr>
                                <th>ID</th>
                                <th>Screen</th>
                                <th>Visits</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($screenVisits))
                                <?php $x = 1; ?>
                                @foreach($screenVisits as $visit)
                                    <tr>
                                        <td>{{ $x }}</td>
                                        <td>{{$visit->page_type}} </td>
                                        <td>{{$visit->count}}  </td>
                                    </tr>
                                    <?php $x++; ?>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
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
    <script type="text/javascript">
        $(document).ready(function()
        {
            $('#export_screen_visit').on('click',function(e)
            {
                e.preventDefault();
                var dateFrom = $('#dateFrom').val();
                var dateTo = $('#dateTo').val();
                var pageType = $('#pageType').val();

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '<?= env('APP_URL') ?>rcpadmin/screen-export',
                    data: {dateFrom: dateFrom, dateTo: dateTo, pageType: pageType},
                    type: 'GET',
                    success: function (data) {
                        console.log(data);
                    }
                });

            });
        });
    </script>

@stop