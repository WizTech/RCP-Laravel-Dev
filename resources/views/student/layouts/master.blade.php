<!DOCTYPE html>
<html lang="en">

<!--================================================================================
	Item Name: Materialize - Material Design Admin Template
	Version: 3.1
	Author: GeeksLabs
	Author URL: http://www.themeforest.net/user/geekslabs
================================================================================ -->

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="msapplication-tap-highlight" content="no">
  <meta name="description"
        content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google. ">
  <meta name="keywords"
        content="materialize, admin template, dashboard template, flat admin template, responsive admin template,">
  <title> {{ env('ADMIN_TITLE') }}</title>

  <!-- Favicons-->
  <link rel="icon" href="{{ env('THEME_ASSETS') }}images/favicon.ico" sizes="32x32">
  <!-- Favicons-->
  <link rel="apple-touch-icon-precomposed"
        href="{{ env('THEME_ASSETS') }}images/favicon/apple-touch-icon-152x152.png">
  <!-- For iPhone -->
  <meta name="msapplication-TileColor" content="#00bcd4">
  <meta name="msapplication-TileImage" content="{{ env('THEME_ASSETS') }}images/favicon/mstile-144x144.png">
  <!-- For Windows Phone -->


  <!-- CORE CSS-->
  <link href="{{ env('THEME_ASSETS') }}css/materialize.min.css" type="text/css" rel="stylesheet"
        media="screen,projection">
  <link href="{{ env('THEME_ASSETS') }}css/style.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  <!-- Custome CSS-->
  <link href="{{ env('THEME_ASSETS') }}css/custom/custom.min.css" type="text/css" rel="stylesheet"
        media="screen,projection">


  <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
  <link href="{{ env('THEME_ASSETS') }}js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css"
        rel="stylesheet" media="screen,projection">
  <link href="{{ env('THEME_ASSETS') }}js/plugins/jvectormap/jquery-jvectormap.css" type="text/css" rel="stylesheet"
        media="screen,projection">
  <link href="{{ env('THEME_ASSETS') }}js/plugins/chartist-js/chartist.min.css" type="text/css" rel="stylesheet"
        media="screen,projection">


  @yield('styles')

</head>

<body>
<!-- Start Page Loading -->
<div id="loader-wrapper">
  <div id="loader"></div>
  <div class="loader-section section-left"></div>
  <div class="loader-section section-right"></div>
</div>
<!-- End Page Loading -->

<!-- //////////////////////////////////////////////////////////////////////////// -->

<!-- START HEADER -->
<header id="header" class="page-topbar">
  <!-- start header nav-->
  <div class="navbar-fixed">
    <nav class="navbar-color">
      <div class="nav-wrapper">
        <ul class="left">
          <li><h1 class="logo-wrapper"><a href="{{ env('ADMIN_URL') }}" class="brand-logo darken-1"><img
                  src="{{ env('THEME_ASSETS') }}images/rcp-logo.png" alt="Rent College Pads logo"></a>
              <span class="logo-text">Materialize</span></h1></li>
        </ul>

      </div>
    </nav>
  </div>
  <!-- end header nav-->
</header>
<!-- END HEADER -->

<!-- //////////////////////////////////////////////////////////////////////////// -->

<!-- START MAIN -->
<div id="main">
  <!-- START WRAPPER -->
  <div class="wrapper">


    @include('rcpadmin.layouts.nav')

    @yield('content')


  </div>
  <!-- END WRAPPER -->

</div>
<!-- END MAIN -->


<!-- //////////////////////////////////////////////////////////////////////////// -->

<!-- START FOOTER -->
<footer class="page-footer">

  <div class="footer-copyright">
    <div class="container">
      Copyright © {{ date('Y')  }} <a class="grey-text text-lighten-4"
                                      href="http://themeforest.net/user/geekslabs/portfolio?ref=geekslabs"
                                      target="_blank">Rent College Pads</a> All rights reserved.

    </div>
  </div>
</footer>
<!-- END FOOTER -->


<!-- ================================================
Scripts
================================================ -->

<!-- jQuery Library -->
<script type="text/javascript" src="{{ env('THEME_ASSETS') }}js/plugins/jquery-1.11.2.min.js"></script>

<!--materialize js-->
<script type="text/javascript" src="{{ env('THEME_ASSETS') }}js/materialize.min.js"></script>
<!--scrollbar-->
<script type="text/javascript"
        src="{{ env('THEME_ASSETS') }}js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>


@yield('scripts')

<script>
  $(document).ready(function () {
    $("select").material_select();
    $('.child-element').on('click', function () {
      $('.child-element').removeClass('active')
      $(this).addClass('active')
      $('.collapsible-body').css('display', 'block');

    })
    $('.collapsible-header').on('click', function () {
      if ($(this).hasClass('active')) {
        $('.collapsible-body').css('display', 'none');
        $(this).removeClass('active')
      } else {
        $('.collapsible-body').css('display', 'block');
        $(this).addClass('active')
      }
    })
  })
</script>


<!--plugins.js - Some Specific JS codes for Plugin Settings-->
<script type="text/javascript" src="{{ env('THEME_ASSETS') }}js/plugins.min.js"></script>
<!--custom-script.js - Add your own theme custom JS-->
<script type="text/javascript" src="{{ env('THEME_ASSETS') }}js/custom-script.js"></script>

</body>

</html>