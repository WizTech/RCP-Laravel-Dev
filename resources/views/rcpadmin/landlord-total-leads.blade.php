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
            <li><a href="{{'landlord-site-leads'}}">Landlord Site Leads</a></li>
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
                        @if(!empty($leads['campuses']))
                            @foreach($leads['campuses'] as $campus)
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
                            <select class="select-box-in" name="campus_id" id="campusId">
                                <option value="All">All Campuses</option>
                                @if(!empty($leads['campuses']))
                                    @foreach($leads['campuses'] as $campus)
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

                                <th>Landlord ID</th>
                                <th>Landlord Username</th>
                                <th>Action</th>

                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($landlords))
                                @foreach( $landlords as $landlord)
                                    <tr>
                                        <td>{{$landlord->id}} </td>
                                        <td>{{$landlord->name}} </td>
                                        <td>N/A</td>


                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                        @if(isset($landlords) && count($landlords) > 0)
                            {{$landlords->links()}}
                            Showing {{$landlords->firstItem()}} to {{$landlords->lastItem()}}
                            of {{$landlords->total()}}
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