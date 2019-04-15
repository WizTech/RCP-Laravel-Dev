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
        <h4 class="page-title pull-left">Application Leads</h4>
        <ul class="breadcrumbs pull-left">
            <li><a href="{{ url('rcpadmin/').'/' }}">Dashboard</a></li>
            <li><span>Application Stats / </span></li>
            <li><a href="{{'app-leads'}}"> Leads</a></li>
        </ul>
    </div>
@stop
@section('content')
    <div class="row">
        <div class="col-12 mt-5">
            <div align="center">
                <form action="{{url('rcpadmin/lead-export')}}" method="get">
                    Date From <input type="text" name="date_from" value="<?= date("Y-m-d", strtotime("-1 month")) ?>"
                                     class="filter-box datePicker">
                    To <input type="text" name="date_to" value="<?= date("Y-m-d") ?>" class="filter-box datePicker">
                    <select class="select-box" name="lead_type">
                        <option value="All">All Leads</option>
                        <option value="call">Call</option>
                        <option value="email">Email</option>
                        <option value="fav">Favorites</option>
                    </select>
                    <select class="filter-box" name="campus_id">
                        <option value="All">All Campuses</option>
                        @if(!empty($appLeads['campuses']))
                            @foreach($appLeads['campuses'] as $campus)
                                <option value="{{$campus->id}}">{{$campus->title}}</option>
                            @endforeach
                        @endif
                    </select>
                    <button type="submit" class="btn btn-success btn-lg"> EXPORT LIST</button>
                </form>
            </div>
            <div align="right" style="padding-right: 15%;">
                <form action="{{url('rcpadmin/app-leads')}}" method="get">
                    <select class="select-box" name="lead_type" id="leadType">
                        <option value="All"><a href="{{'app-leads'}}">All Leads</a></option>
                        <option value="call">Call</option>
                        <option value="email">Email</option>
                        <option value="fav">Favorites</option>
                    </select>
                <select class="select-box" name="campus_id" id="campusId">
                    <option value="All">All Campuses</option>
                    @if(!empty($appLeads['campuses']))
                        @foreach($appLeads['campuses'] as $campus)
                            <option value="{{$campus->id}}">{{$campus->title}}</option>
                        @endforeach
                    @endif
                </select>
                </form>
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
                                <th>Lead Type</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty( $appLeads['leads']))
                                <?php $x = 1; ?>
                                @foreach( $appLeads['leads'] as $lead)
                                    @if(!empty($lead->username && $lead->campus_title))
                                        <tr>
                                            <td>{{ $x }}</td>
                                            <td>{{$lead->username}} </td>
                                            <td>{{$lead->email}} </td>
                                            <td>{{$lead->phone_no}} </td>
                                            <td>{{$lead->campus_title}} </td>
                                            <td>{{$lead->lead_type}}</td>
                                            <td>{{date("Y-m-d",strtotime($lead->date))}}</td>
                                        </tr>
                                        <?php $x++; ?>
                                    @endif
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