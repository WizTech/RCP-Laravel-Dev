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
        <h4 class="page-title pull-left">App Leads</h4>
        <ul class="breadcrumbs pull-left">
            <li><a href="{{ url('rcpadmin/').'/' }}">Dashboard</a></li>
            <li><span>App Leads</span></li>
        </ul>
    </div>
@stop
@section('content')
    <div class="row">
        <div class="col-12 mt-5">
            <div align="center">
                Date From <input class="filter-box" type="date" name="date_from">
                To <input class="filter-box" type="date" name="date_to">
                <select class="filter-box" name="lead">
                    <option value="">All Leads</option>
                    @if(!empty($appViews['leads']))
                        @foreach($appViews['leads'] as $page)
                            <option value="">{{$page}}</option>
                        @endforeach
                    @endif
                </select>
                <select class="filter-box" name="campus">
                    <option value="">All Campuses</option>
                    @if(!empty($appLeads))
                        @foreach($appLeads as $appLead)
                            @if(!empty($appLead->campus_id && $appLead->campus_title))
                                <option value="{{$appLead->campus_id}}">{{$appLead->campus_title}}</option>
                            @endif
                        @endforeach
                    @endif
                </select>
                <a href="{{ url('rcpadmin/csv-export') }}" class="btn btn-success btn-lg"> Export List </a>
            </div>
            <div align="right" style="padding-right: 15%;">
                <select class="select-box" name="page">
                    <option value="">All Leads</option>
                    @if(!empty($appLeads))
                        @foreach($appLeads as $appLead)
                            <option value="{{$appLead->id}}">{{$appLead->lead_type}}</option>
                        @endforeach
                    @endif
                </select>
                <select class="select-box" name="campus">
                    <option value="">All Campuses</option>
                    @if(!empty($appLeads))
                        @foreach($appLeads as $appLead)
                            @if(!empty($appLead->campus_id && $appLead->campus_title))
                                <option value="{{$appLead->campus_id}}">{{$appLead->campus_title}}</option>
                            @endif
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
                                <th>Lead Type</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($appLeads))
                                <?php $x = 1; ?>
                                @foreach($appLeads as $lead)
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
    <script>
        $('.delete').click(function () {
            return confirm("Are you sure you want to delete?");
        })
    </script>
@stop