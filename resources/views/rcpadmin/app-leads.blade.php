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
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{url('rcpadmin/app-leads')}}" method="get">
                            <select class="select-box-in" name="lead_type" id="leadType">
                                <option value="All" <?= isset($_GET['lead_type']) && $_GET['lead_type'] == 'All' ? 'selected' : '' ?> >
                                    All Leads
                                </option>
                                <option value="call" <?= isset($_GET['lead_type']) && $_GET['lead_type'] == 'call' ? 'selected' : '' ?> >
                                    Call
                                </option>
                                <option value="email" <?= isset($_GET['lead_type']) && $_GET['lead_type'] == 'email' ? 'selected' : '' ?> >
                                    Email
                                </option>
                                <option value="fav" <?= isset($_GET['lead_type']) && $_GET['lead_type'] == 'fav' ? 'selected' : '' ?> >
                                    Favorites
                                </option>
                            </select>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <form action="{{url('rcpadmin/app-leads')}}" method="get">
                            <select class="select-box-in" name="campus_id" id="campusId">
                                <option value="All">All Campuses</option>
                                @if(!empty($appLeads['campuses']))
                                    @foreach($appLeads['campuses'] as $campus)
                                        <?php if (isset($_GET['campus_id']) && $_GET['campus_id'] == $campus->id): ?>
                                        <option value="{{$campus->id}}" selected>{{$campus->title}}</option>
                                        <?php else: ?>
                                        <option value="{{$campus->id}}">{{$campus->title}}</option>
                                        <?php endif; ?>
                                    @endforeach
                                @endif
                            </select>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive datatable-dark">
                        <table class="text-center table">
                            <thead class="text-capitalize">
                            <tr>
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Campus</th>
                                <th>Lead Type</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($appLeads['leads']))
                                @foreach( $appLeads['leads'] as $lead)
                                    <tr>
                                        <td>{{$lead->username}} </td>
                                        <td>{{$lead->email}} </td>
                                        <td>{{$lead->phone_no}} </td>
                                        <td>{{$lead->campus_title}} </td>
                                        <td>{{$lead->lead_type}}</td>
                                        <td>{{date("Y-m-d",strtotime($lead->date))}}</td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                        @if(isset($appLeads['leads']) && count($appLeads['leads']) > 0)
                            {{$appLeads['leads']->links()}}
                            Showing {{$appLeads['leads']->firstItem()}} to {{$appLeads['leads']->lastItem()}}
                            of {{$appLeads['leads']->total()}}
                            Entities
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