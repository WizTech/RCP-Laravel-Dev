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
        <h4 class="page-title pull-left">Application Visits</h4>
        <ul class="breadcrumbs pull-left">
            <li><a href="{{ url('rcpadmin/').'/' }}">Dashboard</a></li>
            <li><span>Application Stats / Visits</span></li>
        </ul>
    </div>
@stop
@section('content')
    <div class="row">
        <div class="col-12 mt-5">
            <div align="center">
                Date From <input class="filter-box" type="date" name="date_from">
                To <input class="filter-box" type="date" name="date_to">
                <select class="filter-box" name="campus">
                    <option value="">All Campuses</option>
                    @if(!empty($appViews['campuses']))
                        @foreach($appViews['campuses'] as $campus)
                            <option value="{{$campus->id}}">{{$campus->title}}</option>
                            @endforeach
                        @endif
                </select>
                <select class="select-box" name="page">
                    <option value="">All Pages</option>
                    <option value="home">Home</option>
                    <option value="campus">Campus</option>
                    <option value="detail">Detail</option>
                    <option value="favorite">Favorite</option>
                    <option value="contact">Contact</option>
                    <option value="call-landlord">Call-Landlord</option>
                    <option value="email-landlord">Email-Landlord</option>
                    <option value="settings">Settings</option>
                    <option value="settings">Settings</option>
                    <option value="messages">Messages</option>
                    <option value="home-map">Home-Map</option>
                    <option value="home-listing">Home-Listing</option>
                    <option value="roommats-detail">Roommats-Detail</option>
                    <option value="subleases-detail">Subleases-Detail</option>
                </select>
                <a href="{{ url('rcpadmin/csv-export') }}" class="btn btn-success btn-lg"> EXPORT LIST </a>
            </div>
            <div align="right" style="padding-right: 15%;">
                <select class="select-box" name="page">
                    <option value="">All Pages</option>
                            <option value="home">Home</option>
                            <option value="campus">Campus</option>
                            <option value="detail">Detail</option>
                            <option value="favorite">Favorite</option>
                            <option value="contact">Contact</option>
                            <option value="call-landlord">Call-Landlord</option>
                            <option value="email-landlord">Email-Landlord</option>
                            <option value="settings">Settings</option>
                            <option value="settings">Settings</option>
                            <option value="messages">Messages</option>
                            <option value="home-map">Home-Map</option>
                            <option value="home-listing">Home-Listing</option>
                            <option value="roommats-detail">Roommats-Detail</option>
                            <option value="subleases-detail">Subleases-Detail</option>
                </select>
                <select class="select-box" name="campus">
                    <option value="">All Campuses</option>
                    @if(!empty($appViews['campuses']))
                        @foreach($appViews['campuses'] as $campus)
                            <option value="{{$campus->id}}">{{$campus->title}}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="data-tables datatable-dark">
                        <table id="dataTable3" class="text-center">
                            <thead class="text-capitalize">
                            <tr>
                                <th>ID</th>
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Campus</th>
                                <th>Page</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($appViews['visits']))
                                <?php $x = 1; ?>
                                @foreach($appViews['visits'] as $view)
                                    <tr>
                                        <td>{{ $x }}</td>
                                        <td>{{$view->username}} </td>
                                        <td>{{$view->email}}  </td>
                                        <td>{{$view->phone_no}}</td>
                                        <td>{{$view->campus_title}} </td>
                                        <td>{{$view->page_type}} </td>
                                        <td>{{date("Y-m-d",strtotime($view->date))}}</td>
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
@stop