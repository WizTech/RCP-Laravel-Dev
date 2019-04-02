<!doctype html>
<html class="no-js" lang="en">


<!-- Mirrored from colorlib.com/polygon/srtdash/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 06 Nov 2018 12:51:03 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8"/><!-- /Added by HTTrack -->
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title> {{ env('ADMIN_TITLE') }}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" type="image/png" href="{{ env('THEME_ASSETS_NEW') }}assets/images/favicon.ico">
  <link rel="stylesheet" href="{{ env('THEME_ASSETS_NEW') }}assets/css/bootstrap.min.css?v=7">
  <link rel="stylesheet" href="{{ env('THEME_ASSETS_NEW') }}assets/css/font-awesome.min.css">
  <link rel="stylesheet" href="{{ env('THEME_ASSETS_NEW') }}assets/css/themify-icons.css">
  <link rel="stylesheet" href="{{ env('THEME_ASSETS_NEW') }}assets/css/metisMenu.css">
  <link rel="stylesheet" href="{{ env('THEME_ASSETS_NEW') }}assets/css/owl.carousel.min.css">
  <link rel="stylesheet" href="{{ env('THEME_ASSETS_NEW') }}assets/css/slicknav.min.css">



  <!-- modernizr css -->

  @yield('styles')

  <link rel="stylesheet" href="{{ env('THEME_ASSETS_NEW') }}assets/css/typography.css">
  <link rel="stylesheet" href="{{ env('THEME_ASSETS_NEW') }}assets/css/default-css.css">
  <link rel="stylesheet" href="{{ env('THEME_ASSETS_NEW') }}assets/css/styles.css">
  <link rel="stylesheet" href="{{ env('THEME_ASSETS_NEW') }}assets/css/responsive.css">
  <script src="{{ env('THEME_ASSETS_NEW') }}assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
  your browser</a> to improve your experience.</p>
<![endif]-->
<!-- preloader area start -->
<div id="preloader">
  <div class="loader"></div>
</div>
<!-- preloader area end -->
<!-- page container area start -->
<div class="page-container">
  <!-- sidebar menu area start -->
  <div class="sidebar-menu">
    <div class="sidebar-header">
      <div class="logo">
        <a href="index-2.html"><img src="{{ env('THEME_ASSETS_NEW') }}assets/images/rcp-logo-big.png" alt="logo"></a>
      </div>
    </div>
    <div class="main-menu">
      <div class="menu-inner">
        @include('rcpadmin.layouts.sidebar')

      </div>
    </div>
  </div>
  <!-- sidebar menu area end -->
  <!-- main content area start -->
  <div class="main-content">
    <!-- header area start -->
    <div class="header-area">
      <div class="row align-items-center">
        <!-- nav and search button -->
        <div class="col-md-6 col-sm-8 clearfix">
          <div class="nav-btn pull-left">
            <span></span>
            <span></span>
            <span></span>
          </div>
          <div class="search-box pull-left">
            <form action="#">
              <input type="text" name="search" placeholder="Search..." required>
              <i class="ti-search"></i>
            </form>
          </div>
        </div>
        <!-- profile info & task notification -->
        <div class="col-md-6 col-sm-4 clearfix">
          <ul class="notification-area pull-right">
            <li id="full-view"><i class="ti-fullscreen"></i></li>
            <li id="full-view-exit"><i class="ti-zoom-out"></i></li>
                        
                             
                     <li class="settings-btn">
              <i class="ti-settings"></i>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <!-- header area end -->
    <!-- page title area start -->
    <div class="page-title-area">
      <div class="row align-items-center">
        <div class="col-sm-6">
          @yield('breadcrumbs')

        </div>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
        <div class="col-sm-6 clearfix">
          <div class="user-profile pull-right">
            <img class="avatar user-thumb" src="{{ env('THEME_ASSETS_NEW') }}assets/images/author/avatar.png"
                 alt="avatar">
            <h4 class="user-name dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }} <i
                class="fa fa-angle-down"></i></h4>
            <div class="dropdown-menu">
              {{-- <a class="dropdown-item" href="#">Message</a>
               <a class="dropdown-item" href="#">Settings</a>--}}
              <a class="dropdown-item" href="{{ route('logout') }}"
                 onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log Out</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- page title area end -->
    <div class="main-content-inner">

      @yield('content')
    </div>
  </div>
  <!-- main content area end -->
  <!-- footer area start-->
  <footer>
    <div class="footer-area">
      <p>© Copyright {{ date('Y')  }}. All right reserved. <a href="https://www.rentcollegepads.com/">Rent College
          Pads</a>.</p>
    </div>
  </footer>
  <!-- footer area end-->
</div>
<!-- page container area end -->
<!-- offset area start -->
<div class="offset-area">
  <div class="offset-close"><i class="ti-close"></i></div>
  <ul class="nav offset-menu-tab">
    <li><a class="active" data-toggle="tab" href="#activity">Activity</a></li>
    <li><a data-toggle="tab" href="#settings">Settings</a></li>
  </ul>
  <div class="offset-content tab-content">
    <div id="activity" class="tab-pane fade in show active">
      <div class="recent-activity">
        <div class="timeline-task">
          <div class="icon bg1">
            <i class="fa fa-envelope"></i>
          </div>
          <div class="tm-title">
            <h4>Rashed sent you an email</h4>
            <span class="time"><i class="ti-time"></i>09:35</span>
          </div>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse distinctio itaque at.
          </p>
        </div>
        <div class="timeline-task">
          <div class="icon bg2">
            <i class="fa fa-check"></i>
          </div>
          <div class="tm-title">
            <h4>Added</h4>
            <span class="time"><i class="ti-time"></i>7 Minutes Ago</span>
          </div>
          <p>Lorem ipsum dolor sit amet consectetur.
          </p>
        </div>
        <div class="timeline-task">
          <div class="icon bg2">
            <i class="fa fa-exclamation-triangle"></i>
          </div>
          <div class="tm-title">
            <h4>You missed you Password!</h4>
            <span class="time"><i class="ti-time"></i>09:20 Am</span>
          </div>
        </div>
        <div class="timeline-task">
          <div class="icon bg3">
            <i class="fa fa-bomb"></i>
          </div>
          <div class="tm-title">
            <h4>Member waiting for you Attention</h4>
            <span class="time"><i class="ti-time"></i>09:35</span>
          </div>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse distinctio itaque at.
          </p>
        </div>
        <div class="timeline-task">
          <div class="icon bg3">
            <i class="ti-signal"></i>
          </div>
          <div class="tm-title">
            <h4>You Added Kaji Patha few minutes ago</h4>
            <span class="time"><i class="ti-time"></i>01 minutes ago</span>
          </div>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse distinctio itaque at.
          </p>
        </div>
        <div class="timeline-task">
          <div class="icon bg1">
            <i class="fa fa-envelope"></i>
          </div>
          <div class="tm-title">
            <h4>Ratul Hamba sent you an email</h4>
            <span class="time"><i class="ti-time"></i>09:35</span>
          </div>
          <p>Hello sir , where are you, i am egerly waiting for you.
          </p>
        </div>
        <div class="timeline-task">
          <div class="icon bg2">
            <i class="fa fa-exclamation-triangle"></i>
          </div>
          <div class="tm-title">
            <h4>Rashed sent you an email</h4>
            <span class="time"><i class="ti-time"></i>09:35</span>
          </div>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse distinctio itaque at.
          </p>
        </div>
        <div class="timeline-task">
          <div class="icon bg2">
            <i class="fa fa-exclamation-triangle"></i>
          </div>
          <div class="tm-title">
            <h4>Rashed sent you an email</h4>
            <span class="time"><i class="ti-time"></i>09:35</span>
          </div>
        </div>
        <div class="timeline-task">
          <div class="icon bg3">
            <i class="fa fa-bomb"></i>
          </div>
          <div class="tm-title">
            <h4>Rashed sent you an email</h4>
            <span class="time"><i class="ti-time"></i>09:35</span>
          </div>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse distinctio itaque at.
          </p>
        </div>
        <div class="timeline-task">
          <div class="icon bg3">
            <i class="ti-signal"></i>
          </div>
          <div class="tm-title">
            <h4>Rashed sent you an email</h4>
            <span class="time"><i class="ti-time"></i>09:35</span>
          </div>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse distinctio itaque at.
          </p>
        </div>
      </div>
    </div>
    <div id="settings" class="tab-pane fade">
      <div class="offset-settings">
        <h4>General Settings</h4>
        <div class="settings-list">
          <div class="s-settings">
            <div class="s-sw-title">
              <h5>Notifications</h5>
              <div class="s-swtich">
                <input type="checkbox" id="switch1"/>
                <label for="switch1">Toggle</label>
              </div>
            </div>
            <p>Keep it 'On' When you want to get all the notification.</p>
          </div>
          <div class="s-settings">
            <div class="s-sw-title">
              <h5>Show recent activity</h5>
              <div class="s-swtich">
                <input type="checkbox" id="switch2"/>
                <label for="switch2">Toggle</label>
              </div>
            </div>
            <p>The for attribute is necessary to bind our custom checkbox with the input.</p>
          </div>
          <div class="s-settings">
            <div class="s-sw-title">
              <h5>Show your emails</h5>
              <div class="s-swtich">
                <input type="checkbox" id="switch3"/>
                <label for="switch3">Toggle</label>
              </div>
            </div>
            <p>Show email so that easily find you.</p>
          </div>
          <div class="s-settings">
            <div class="s-sw-title">
              <h5>Show Task statistics</h5>
              <div class="s-swtich">
                <input type="checkbox" id="switch4"/>
                <label for="switch4">Toggle</label>
              </div>
            </div>
            <p>The for attribute is necessary to bind our custom checkbox with the input.</p>
          </div>
          <div class="s-settings">
            <div class="s-sw-title">
              <h5>Notifications</h5>
              <div class="s-swtich">
                <input type="checkbox" id="switch5"/>
                <label for="switch5">Toggle</label>
              </div>
            </div>
            <p>Use checkboxes when looking for yes or no answers.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- offset area end -->
<!-- jquery latest version -->
<script src="{{ env('THEME_ASSETS_NEW') }}assets/js/vendor/jquery-2.2.4.min.js"></script>
<!-- bootstrap 4 js -->
<script src="{{ env('THEME_ASSETS_NEW') }}assets/js/popper.min.js"></script>
<script src="{{ env('THEME_ASSETS_NEW') }}assets/js/bootstrap.min.js"></script>
<script src="{{ env('THEME_ASSETS_NEW') }}assets/js/owl.carousel.min.js"></script>
<script src="{{ env('THEME_ASSETS_NEW') }}assets/js/metisMenu.min.js"></script>
<script src="{{ env('THEME_ASSETS_NEW') }}assets/js/jquery.slimscroll.min.js"></script>
<script src="{{ env('THEME_ASSETS_NEW') }}assets/js/jquery.slicknav.min.js"></script>

@yield('scripts')
<script src="{{ env('THEME_ASSETS_NEW') }}assets/js/plugins.js"></script>
<script src="{{ env('THEME_ASSETS_NEW') }}assets/js/scripts.js"></script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag() {
    dataLayer.push(arguments);
  }
  gtag('js', new Date());

  gtag('config', 'UA-23581568-13');

</script>
</body>


<!-- Mirrored from colorlib.com/polygon/srtdash/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 06 Nov 2018 12:51:53 GMT -->
</html>
