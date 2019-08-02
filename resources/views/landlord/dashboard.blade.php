@extends('student.layouts.app')

@section('breadcrumbs')
  <div class="breadcrumbs-area clearfix">
    <h4 class="page-title pull-left">Dashboard</h4>
    <ul class="breadcrumbs pull-left">
      <li><a href="{{ url('portal/').'/' }}">Home</a></li>
      <li><span>Dashboard</span></li>
    </ul>
  </div>
@stop
@section('content')
  <!-- START CONTENT -->
  <section id="content">

    <!--start container-->
    <div class="container" style="min-height: 600px">
      <p>In progress</p>
    </div>
  </section>
  <!-- END CONTENT -->
@stop
