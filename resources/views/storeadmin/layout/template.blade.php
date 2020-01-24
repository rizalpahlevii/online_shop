<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">
  <head>
      <meta name="csrf-token" content="{!! csrf_token() !!}">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Robust admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, robust admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>@yield('page') - Online Shop</title>
    <script src="{{asset('backend')}}/js/core/libraries/jquery.min.js" type="text/javascript"></script>

    <link rel="apple-touch-icon" sizes="60x60" href="{{asset('backend')}}/images/ico/apple-icon-60.png">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('backend')}}/images/ico/apple-icon-76.png">
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('backend')}}/images/ico/apple-icon-120.png">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('backend')}}/images/ico/apple-icon-152.png">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('backend')}}/images/ico/icon.ico">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('backend')}}/css/bootstrap.css">
    <!-- font icons-->
    <link rel="stylesheet" type="text/css" href="{{asset('backend')}}/fonts/icomoon.css">
    <link rel="stylesheet" type="text/css" href="{{asset('backend')}}/fonts/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('backend')}}/vendors/css/extensions/pace.css">
    <!-- END VENDOR CSS-->
    <!-- BEGIN ROBUST CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('backend')}}/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="{{asset('backend')}}/css/app.css">
    <link rel="stylesheet" type="text/css" href="{{asset('backend')}}/css/colors.css">
    <!-- END ROBUST CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('backend')}}/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="{{asset('backend')}}/css/core/menu/menu-types/vertical-overlay-menu.css">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('backend')}}/assets/css/style.css">
    <!-- END Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{url('assets')}}/DataTables/DataTables-1.10.20/css/dataTables.bootstrap4.css">
    <script src="{{url('assets')}}/ckeditor5/ckeditor.js"></script>
    
    <link rel="stylesheet" href="{{url('assets')}}/sweetalert2/dist/sweetalert2.min.css">
    <script src="{{url('assets')}}/sweetalert2/dist/sweetalert2.min.js"></script>
   
  </head>
  <body data-open="click" data-menu="vertical-menu" data-col="2-columns" class="vertical-layout vertical-menu 2-columns  fixed-navbar">

    <!-- navbar-fixed-top-->
    <nav class="header-navbar navbar navbar-with-menu navbar-fixed-top navbar-semi-dark navbar-shadow">
      <div class="navbar-wrapper">
        <div class="navbar-header">
          <ul class="nav navbar-nav">
            <li class="nav-item mobile-menu hidden-md-up float-xs-left"><a class="nav-link nav-menu-main menu-toggle hidden-xs"><i class="icon-menu5 font-large-1"></i></a></li>
            <li class="nav-item">
              <a href="{{route('admin.dashboard')}}" class="navbar-brand nav-link">
                <img alt="branding logo" src="{{asset('backend')}}/images/logo/robust-logo-light.png" data-expand="{{asset('backend')}}/images/logo/robust-logo-light.png" data-collapse="{{asset('backend')}}/images/logo/robust-logo-small.png" class="brand-logo">
              </a>
            </li>
            <li class="nav-item hidden-md-up float-xs-right"><a data-toggle="collapse" data-target="#navbar-mobile" class="nav-link open-navbar-container"><i class="icon-ellipsis pe-2x icon-icon-rotate-right-right"></i></a></li>
          </ul>
        </div>
        <div class="navbar-container content container-fluid">
          <div id="navbar-mobile" class="collapse navbar-toggleable-sm">
            <ul class="nav navbar-nav">
              <li class="nav-item hidden-sm-down"><a class="nav-link nav-menu-main menu-toggle hidden-xs"><i class="icon-menu5"></i></a></li>
              <li class="nav-item hidden-sm-down"><a href="#" class="nav-link nav-link-expand"><i class="ficon icon-expand2"></i></a></li>
              <li class="nav-item hidden-sm-down"><a href="" target="_blank" class="btn btn-success upgrade-to-pro"><i class="icon-office"></i>{{$store->name}}</a></li>
              
            </ul>
            <ul class="nav navbar-nav float-xs-right">
              
              <li class="dropdown dropdown-user nav-item"><a href="#" data-toggle="dropdown" class="dropdown-toggle nav-link dropdown-user-link"><span class="avatar avatar-online"><img src="{{asset('backend')}}/images/portrait/small/avatar-s-1.png" alt="avatar"><i></i></span><span class="user-name">{{Auth::user()->name}}</span></a>
                <div class="dropdown-menu dropdown-menu-right">
                <a href="{{route('admin.profile_index')}}" class="dropdown-item"><i class="icon-head"></i> Edit Profile</a>
                <a href="{{route('admin.profile_password')}}" class="dropdown-item"><i class="icon-key2"></i> Change Password</a>

                  <div class="dropdown-divider"></div><a href="{{route('logout')}}" onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();" class="dropdown-item"><i class="icon-power3"></i> Logout</a>
                </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>

    <!-- ////////////////////////////////////////////////////////////////////////////-->


    <!-- main menu-->
    <div data-scroll-to-active="true" class="main-menu menu-fixed menu-dark menu-accordion menu-shadow">
     
      <!-- main menu content-->
      <div class="main-menu-content">
        @include('storeadmin.partials.sidebar')
      </div>
      <!-- /main menu content-->
      <!-- main menu footer-->
      <!-- include includes/menu-footer-->
      <!-- main menu footer-->
    </div>
    <!-- / main menu-->

    <div class="app-content content container-fluid">
     @yield('content')
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->


    <footer class="footer footer-static footer-light navbar-border">
      <p class="clearfix text-muted text-sm-center mb-0 px-2"><span class="float-md-left d-xs-block d-md-inline-block">Copyright  &copy; 2017 <a href="https://themeforest.net/user/pixinvent/portfolio?ref=pixinvent" target="_blank" class="text-bold-800 grey darken-2">PIXINVENT </a>, All rights reserved. </span><span class="float-md-right d-xs-block d-md-inline-block">Hand-crafted & Made with <i class="icon-heart5 pink"></i></span></p>
    </footer>

    <!-- BEGIN VENDOR JS-->
    <script src="{{asset('backend')}}/js/core/libraries/jquery.min.js" type="text/javascript"></script>
    <script src="{{asset('backend')}}/vendors/js/ui/tether.min.js" type="text/javascript"></script>
    <script src="{{asset('backend')}}/js/core/libraries/bootstrap.min.js" type="text/javascript"></script>
    <script src="{{asset('backend')}}/vendors/js/ui/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
    <script src="{{asset('backend')}}/vendors/js/ui/unison.min.js" type="text/javascript"></script>
    <script src="{{asset('backend')}}/vendors/js/ui/blockUI.min.js" type="text/javascript"></script>
    <script src="{{asset('backend')}}/vendors/js/ui/jquery.matchHeight-min.js" type="text/javascript"></script>
    <script src="{{asset('backend')}}/vendors/js/ui/screenfull.min.js" type="text/javascript"></script>
    <script src="{{asset('backend')}}/vendors/js/extensions/pace.min.js" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN ROBUST JS-->
    <script src="{{asset('backend')}}/js/core/app-menu.js" type="text/javascript"></script>
    <script src="{{asset('backend')}}/js/core/app.js" type="text/javascript"></script>
    <script type="text/javascript" src="{{url('assets')}}/DataTables/DataTables-1.10.20/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="{{url('assets')}}/DataTables/DataTables-1.10.20/js/dataTables.bootstrap4.js"></script>
    {{-- <script type="text/javascript" src="{{url('assets')}}/chartjs/Chart.bundle.js"></script> --}}
    <script type="text/javascript" src="{{url('assets')}}/highcharts/highcharts.js"></script>
    <script>
      $(document).ready(function(){
        $('#table-backend').dataTable();
        $('#table-transaction').dataTable({ 
          "scrollX": true
        });
      });
    </script>
    @stack('script')
    <!-- END ROBUST JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <!-- END PAGE LEVEL JS-->
  </body>
</html>
